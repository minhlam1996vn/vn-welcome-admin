@extends('layouts.admin')

@section('page-title', 'Thêm mới bài viết')

@push('styles')
    <style>
        /*  */
    </style>
@endpush

@section('content')
    <form action="">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Biên tập</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề bài viết">
                        </div>

                        <div class="mb-3">
                            <textarea rows="3" name="description" class="form-control" placeholder="Nhập phần mô tả bài viết"></textarea>
                        </div>

                        <div class="mb-3">
                            <div id="toolbar-container" class="shadow rounded"></div>
                            <div id="editor"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Cài đặt Media</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <select class="form-select" name="category">
                                <option disabled selected>Cài đặt danh mục</option>
                                <option value="">Con người Việt Nam</option>
                                <option value="">Ngày lễ và những trải nghiệm</option>
                                <option value="">Tin tức thị trường</option>
                                <option value="">63 Tỉnh thành</option>
                                <option value="">Ẩm thực - Du lịch</option>
                                <option value="">Blog</option>
                                <option value="">Âm thanh - Hình ảnh</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Cài đặt tag">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="text-center">
        <button class="btn btn-primary shadow">Thêm bài viết</button>
    </div>
@endsection

@push('scripts')
    {{-- https://ckeditor.com/docs/ckeditor5/latest/installation/getting-started/quick-start.html --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/decoupled-document/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/translations/vi.js"></script>
    <script>
        DecoupledEditor
            .create(document.querySelector('#editor'), {
                language: 'vi',
                placeholder: 'Nhập nội dung chi tiết!',
                ckfinder: {
                    uploadUrl: "{{ route('admin.upload', ['_token' => csrf_token()]) }}",
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
    </script>
@endpush
