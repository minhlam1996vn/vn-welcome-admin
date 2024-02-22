@extends('layouts.admin')

@section('page-title', 'Thêm tag')

@section('content')
    <form method="POST" action="{{ route('admin.tag.store') }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên tag</label>
                            <span class="text-danger">(*)</span>
                            <input type="text" name="tag_name" value="" class="form-control"
                                placeholder="Nhập tên tag">
                            @error('tag_name')
                                <div class="mt-1 text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả tag</label>
                            <textarea name="tag_description" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Từ khóa tag</label>
                            <textarea name="tag_keywords" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary shadow">Thêm tag</button>
        </div>
    </form>
@endsection
