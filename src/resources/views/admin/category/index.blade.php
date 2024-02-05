@extends('layouts.admin')

@section('page-title', 'Quản lý danh mục')

@section('page-button')
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary float-end mt-n1">
        <i class="align-middle" data-feather="plus"></i>
        Thêm mới
    </a>
@endsection

@section('content')
    <div class="card shadow-lg">
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

    <x-pagination :links="$categories->onEachSide(0)->links()" :show-limit="false" />
@endsection
