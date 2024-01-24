@extends('layouts.admin')

@section('page-title', 'Quản lý danh mục')

@section('page-button')
    <a href="#" class="btn btn-primary float-end mt-n1">
        <i class="align-middle" data-feather="plus"></i>
        Thêm mới
    </a>
@endsection

@section('content')
    <div class="card shadow-lg">
        <div class="card-body">
            <form method="GET">
                <div class="d-flex align-items-end" style="gap: 10px">
                    <div class="rounded">
                        <div class="d-flex align-items-center">
                            <label class="me-2">Danh mục</label>
                            <div>
                                <input type="email" class="form-control" placeholder="Nhập tên danh mục">
                            </div>
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

    <div class="card shadow-lg">
        <div class="card-header pb-0 text-center">
            <div class="d-inline-block">
                <ul class="pagination mb-0">
                    <li class="paginate_button page-item active"><a href="#" aria-controls="datatables-reponsive"
                            aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="datatables-reponsive"
                            aria-role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="datatables-reponsive"
                            aria-role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a></li>
                </ul>
            </div>
        </div>
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
                                <img src="https://demo.adminkit.io/img/avatars/avatar.jpg" width="32" height="32"
                                    class="rounded-circle my-n1" alt="Avatar">
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
        <div class="card-footer pt-0 text-center">
            <div class="d-inline-block">
                <ul class="pagination mb-0">
                    <li class="paginate_button page-item active"><a href="#" aria-controls="datatables-reponsive"
                            aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="datatables-reponsive"
                            aria-role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="datatables-reponsive"
                            aria-role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
