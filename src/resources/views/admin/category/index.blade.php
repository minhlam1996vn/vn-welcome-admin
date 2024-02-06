@extends('layouts.admin')

@section('page-title', 'Quản lý danh mục')

@push('styles')
    <style>
        .list-group-item:hover {
            background-color: rgba(0, 0, 0, 0.1)
        }
    </style>
@endpush

@section('page-button')
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary float-end mt-n1">
        <i class="align-middle" data-feather="plus"></i>
        Thêm mới
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Sắp xếp danh mục</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <div id="list-category" class="list-group col">
                            @forelse ($categories as $category)
                                <div data-id="{{ $category->id }}"
                                    class="list-group-item nested-1 border rounded shadow-lg mb-2 p-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="ms-1">
                                            <span class="text-info cursor-pointer">
                                                {{ $category->category_name }} ({{ $category->id }})
                                            </span>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.category.create') }}"
                                                class="btn btn-sm btn-success rounded">Sửa</a>
                                            <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted">Không có dữ liệu hiển thị</div>
                            @endforelse

                            {{-- <div data-id="1" class="list-group-item nested-1 border rounded shadow-lg mb-2 p-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="ms-1">Con người Việt Nam</div>
                                    <div>
                                        <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                        <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                    </div>
                                </div>
                            </div>
                            <div data-id="2" class="list-group-item nested-1 border rounded shadow-lg mb-2 p-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="ms-1">Ngày lễ và những trải nghiệm</div>
                                    <div>
                                        <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                        <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                    </div>
                                </div>
                            </div>
                            <div data-id="3" class="list-group-item nested-1 border rounded shadow-lg mb-2 p-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="ms-1">Tin tức thị trường</div>
                                    <div>
                                        <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                        <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                    </div>
                                </div>
                            </div>
                            <div data-id="4" class="list-group-item nested-1 border rounded shadow-lg mb-2 p-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="ms-1">63 Tỉnh thành</div>
                                    <div>
                                        <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                        <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                    </div>
                                </div>
                            </div>
                            <div data-id="5" class="list-group-item nested-1 border rounded shadow-lg mb-2 p-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="ms-1">Ẩm thực - Du lịch</div>
                                    <div>
                                        <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                        <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                    </div>
                                </div>
                            </div>
                            <div data-id="6" class="list-group-item nested-2 border rounded shadow-lg mb-2 p-2">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="ms-1">Blog khoa học công nghệ</div>
                                        <div>
                                            <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                            <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group px-2" id="list-sort-6">
                                    <div data-id="7"
                                        class="d-none list-group-item nested-3 border rounded shadow-lg mb-2 p-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="ms-1">Blog tin tức</div>
                                            <div>
                                                <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                                <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-id="8" class="list-group-item nested-3 border rounded shadow-lg mb-2 p-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="ms-1">Blog công nghệ</div>
                                            <div>
                                                <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                                <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-id="9" class="list-group-item nested-3 border rounded shadow-lg mb-2 p-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="ms-1">Blog khoa học</div>
                                            <div>
                                                <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                                <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-id="10" class="list-group-item nested-3 border rounded shadow-lg mb-2 p-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="ms-1">Blog tổng hợp</div>
                                            <div>
                                                <a href="#!" class="btn btn-sm btn-success rounded">Sửa</a>
                                                <button type="button" class="btn btn-sm btn-danger rounded">Xoá</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <form method="POST" action="{{ route('admin.category.updateSortCategories') }}">
            @csrf
            <textarea id="sort-value" class="d-none" name="sort_value"></textarea>
            <button id="get-order" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>

    {{-- <div class="card shadow-lg">
        <form method="GET" action="">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="mb-3 d-flex align-items-center">
                            <label style="width: 100px" for="search-category" class="me-2">Danh mục</label>
                            <div class="w-100">
                                <input type="text" name="category_name" value="{{ request()->category_name }}"
                                    id="search-category" class="form-control" placeholder="Nhập tên danh mục">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5"></div>
                    <div class="col-12 col-md-2">
                        <div class="mb-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary border shadow">
                                Tìm kiếm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="my-4">
        <x-pagination :links="$categories->onEachSide(0)->links()" :show-limit="true" />
    </div>

    <div class="card shadow-lg" style="border-top: 5px solid #3b7ddd; max-height: 60vh; overflow: auto">
        <div class="card-body min-vh-50">
            <table class="table table-responsive table-striped w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="d-none d-md-table-cell">Company</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $key => $category)
                        <tr>
                            <td>
                                {{ ++$key }}
                            </td>
                            <td>
                                {{ $category->category_name }}
                            </td>
                            <td>
                                {{ $category->category_slug }}
                            </td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Không có dữ liệu hiển thị
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-pagination :links="$categories->onEachSide(0)->links()" :show-limit="false" /> --}}
@endsection

@push('scripts')
    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script>
        // List category sortable
        $('#list-category').sortable({
            group: {
                name: 'list',
                pull: 'clone',
                put: false,
            },
            animation: 200,
            onSort: reportActivity,
        });

        // List child category sortable
        $('#list-sort-6').sortable({
            group: {
                name: 'list',
                pull: 'clone',
                put: false,
            },
            animation: 200,
            onSort: reportActivity,
        });

        // Report when the sort order has changed
        function reportActivity() {
            return
        };

        // Arrays of "data-id"
        $('#get-order').click(function() {
            const sortValue = getNestedSortOrder('#list-category');
            $('#sort-value').val(JSON.stringify(sortValue));

            // const sortValue = $('#list-category').sortable('toArray');
            // console.log(sortValue);
        });

        // get nested sort order
        function getNestedSortOrder(selector) {
            const result = [];

            $(selector).find('> .list-group-item').each(function() {
                const item = {
                    id: $(this).data('id'),
                    children: getNestedSortOrder($(this).find('.list-group'))
                };

                result.push(item);
            });

            return result;
        }
    </script>
@endpush
