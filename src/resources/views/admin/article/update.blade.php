@extends('layouts.admin')

@section('page-title', 'Cập nhật bài viết')

@push('styles')
    <link rel="stylesheet" href="{{ asset('build/css/lib/cropper.min.css') }}" />
@endpush

@section('content')
    <form id="form-create-article" action="{{ route('admin.article.update', $article->id) }}" method="POST"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-12 col-lg-8 mb-4">
                <div class="card h-100 position-relative overflow-hidden">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề</label>
                            <span class="text-danger">(*)</span>
                            <input type="text" name="article_title" value="{{ $article->article_title }}"
                                class="form-control" placeholder="Nhập tiêu đề bài viết">
                            @error('article_title')
                                <div class="mt-1 text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea rows="2" name="article_description" class="form-control" placeholder="Nhập phần mô tả bài viết">{{ $article->article_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Từ khóa</label>
                            <textarea rows="2" name="article_keywords" class="form-control" placeholder="Nhập phần mô tả bài viết">{{ $article->article_keywords }}</textarea>
                        </div>

                        <div class="mb-3 form-check">
                            <input id="is-public" type="checkbox" name="status" class="form-check-input position-relative"
                                style="top: 3px">
                            <label class="form-check-label" for="is-public">
                                @if ($article->status === 1 || $article->status === 3)
                                    <span class="btn btn-sm btn-primary rounded-3">Xuất bản</span>
                                @else
                                    <span class="btn btn-sm btn-secondary rounded-3">Tạm dừng</span>
                                @endif
                            </label>
                            <label>
                                @if ($article->status === 1)
                                    <span class="badge badge-secondary-light">Chưa xuất bản</span>
                                @elseif($article->status === 2)
                                    <span class="badge badge-success-light">Đã xuất bản</span>
                                @else
                                    <span class="badge badge-danger-light">Tạm dừng</span>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <span class="text-danger">(*)</span>
                            <select class="form-select" name="category_id">
                                <option value="">--- Chọn danh mục ---</option>
                                {{ showCategories($categories, 0, null, $article->category_id) }}
                            </select>
                            @error('category_id')
                                <div class="mt-1 text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thẻ <small class="text-muted">(Chọn tối đa 3 thẻ)</small></label>
                            <select name="tag_id[]" id="article-tags" class="form-control" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ $article->tags->contains($tag->id) ? 'selected' : '' }}>
                                        {{ $tag->tag_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ảnh hiển thị</label>
                            <div class="mt-1 rounded-4 border">
                                <input type="file" id="article-thumbnail" accept="image/*" name="article_thumbnail"
                                    class="d-none image">
                                <input type="hidden" id="value-image-crop" name="image_base64">
                                <label for="article-thumbnail"
                                    class="btn ratio ratio-16x9 overflow-hidden rounded-4 shadow-lg">
                                    <img id="preview-image-crop"
                                        src="{{ $article->article_thumbnail ? Storage::url($article->article_thumbnail) : 'https://placehold.jp/1280x720.png' }}"
                                        class="w-100 object-fit-cover">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea name="article_content" class="d-none"></textarea>
                            <textarea name="img_path" class="d-none"></textarea>
                            <div id="toolbar-container" class="shadow rounded"></div>
                            <div id="editor-article">{!! $article->article_content !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="button" onclick="createArticle()" class="btn btn-primary shadow">Cập nhật bài viết</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('build/js/lib/cropper.min.js') }}"></script>
    <script src="{{ asset('build/js/lib/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('build/js/lib/ckeditor5/vi.js') }}"></script>
    <script>
        /* --- CHOISES TAG --- */
        $(document).ready(function() {
            var articleTags = document.querySelector("#article-tags");
            var multipleCancelButton = new Choices(articleTags, {
                removeItemButton: true,
                maxItemCount: 3,
                placeholder: true,
                placeholderValue: 'Chọn tags...',
                searchPlaceholderValue: 'Tìm kiếm tags...',
                itemSelectText: 'Nhấn để chọn',
                uniqueItemText: 'Tag này đã tồn tại.',
                noResultsText: 'Không tìm thấy kết quả',
                noChoicesText: 'Không có lựa chọn nào',
                maxItemText: function(maxItemCount) {
                    return 'Chỉ có thể thêm ' + (maxItemCount === 1 ? '1 tag' : maxItemCount + ' tags');
                },
            });
        });
        /* --- END CHOISES TAG --- */

        /* --- CROP IMAGE --- */
        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper, reader, file;

        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                bs_modal.modal('show');
            };


            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        bs_modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 16 / 9,
                viewMode: 3,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop-image").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 1280,
                height: 720,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                let reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    let base64data = reader.result;
                    document.getElementById('preview-image-crop').src = base64data;
                    document.getElementById('value-image-crop').value = base64data;
                    bs_modal.modal('hide');
                };
            });
        });
        /* --- END CROP IMAGE --- */

        /* --- CKEDITOR --- */
        DecoupledEditor
            .create(document.querySelector('#editor-article'), {
                language: 'vi',
                placeholder: 'Nhập nội dung chi tiết!',
                ckfinder: {
                    uploadUrl: "{{ route('admin.media.upload', ['_token' => csrf_token()]) }}&uuid={{ $article->uuid }}",
                },
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Times New Roman, Times, serif',
                    ],
                    supportAllValues: true
                },
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Đoạn văn',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Tiêu đề 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Tiêu đề 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Tiêu đề 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Tiêu đề 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Tiêu đề 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Tiêu đề 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },

            })
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
            })
            .catch(error => {
                console.error(error);
            });

        /* --- END CKEDITOR --- */
        function createArticle() {
            // Get the content of the element with the ID "editor-article"
            const articleContent = document.getElementById("editor-article").innerHTML;

            // Create a hidden div element to contain the content and handle attributes
            const tempDiv = document.createElement("div");
            tempDiv.innerHTML = articleContent;

            // Iterate through all elements with the attribute contenteditable="true" and remove that attribute
            const editableElements = tempDiv.querySelectorAll('[contenteditable="true"]');
            editableElements.forEach((element) => {
                element.removeAttribute('contenteditable');
            });

            // Remove HTML tags with class "ck"
            const resetAllElements = tempDiv.querySelectorAll('.ck');
            resetAllElements.forEach((element) => {
                element.parentNode.removeChild(element);
            });

            // Get the processed content and assign it to the textarea
            const sanitizedContent = tempDiv.innerHTML;
            const textareaElement = document.querySelector('textarea[name="article_content"]');
            textareaElement.value = sanitizedContent;

            // Get the paths of all img elements
            const imgPaths = [];
            const imgElements = tempDiv.querySelectorAll('img');
            imgElements.forEach((img) => {
                const imgPath = img.getAttribute('src');
                if (imgPath) {
                    imgPaths.push(imgPath);
                }
            });
            const textareaImgPathElement = document.querySelector('textarea[name="img_path"]');
            textareaImgPathElement.value = imgPaths;

            // Submit the form with the ID "form-create-article"
            document.getElementById("form-create-article").submit();
        }
    </script>
@endpush
