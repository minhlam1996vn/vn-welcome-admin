@extends('layouts.admin')

@section('page-title', 'Quản lý danh mục')

@section('page-button')
    <a href="#" class="btn btn-primary">Thêm mới</a>
@endsection

@section('content')
    <div class="card shadow p-3">
        <form action="">
            <div class="d-flex justify-content-between">
                <div>
                    <input type="text" class="form-control">
                </div>

                <button class="btn btn-light bg-white border shadow-sm" type="submit">Tìm kiếm</button>
            </div>
        </form>
    </div>

    <div class="card shadow p-3">
        <div style="min-height: 500px">Table</div>
    </div>
@endsection
