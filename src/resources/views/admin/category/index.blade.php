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
        <div class="card-body">
            <form method="GET">
                <div class="d-flex align-items-end" style="gap: 10px">
                    <div class="d-flex align-items-center">
                        <label class="me-2">Danh mục</label>
                        <div>
                            <input type="text" name="category_name" class="form-control" placeholder="Nhập tên danh mục">
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary border shadow" type="submit">
                            Tìm kiếm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="my-4">
        <x-pagination :show-limit="true" />
    </div>

    <div class="card shadow-lg" style="border-top: 5px solid #3b7ddd">
        <div class="card-body">
            <table class="table table-responsive table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="d-none d-md-table-cell">Company</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>
                                {{ $i }}
                            </td>
                            <td>Garrett Winters</td>
                            <td class="d-none d-md-table-cell">Good Guys</td>
                            <td class="d-none d-md-table-cell">garrett@winters.com</td>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    <x-pagination />
@endsection
