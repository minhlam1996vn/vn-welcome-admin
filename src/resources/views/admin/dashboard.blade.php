@extends('layouts.admin')

@section('page-title', 'Tổng quan')

@section('page-button')
    <a href="#" class="btn btn-primary">Thêm mới</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bạn đã đăng nhập!
                </div>
            </div>
        </div>
    </div>
@endsection
