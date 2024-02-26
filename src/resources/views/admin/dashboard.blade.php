@extends('layouts.admin')

@section('page-title', 'Tổng quan')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Bài viết</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="layout"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $articleCount }}</h1>
                    <div class="mb-0">
                        <a href="{{ route('admin.article.index') }}" class="text-info">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
