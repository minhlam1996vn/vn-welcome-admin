@extends('layouts.admin')

@section('page-title', 'Cập nhật tag')

@section('content')
    <form method="POST" action="{{ route('admin.tag.update', $tag->id) }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên tag</label>
                            <span class="text-danger">(*)</span>
                            <input type="text" name="tag_name" value="{{ $tag->tag_name }}" class="form-control"
                                placeholder="Nhập tên tag">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả tag</label>
                            <textarea name="tag_description" class="form-control" rows="2">{{ $tag->tag_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Từ khóa tag</label>
                            <textarea name="tag_keywords" class="form-control" rows="2">{{ $tag->tag_keywords }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary shadow">Cập nhật</button>
        </div>
    </form>
@endsection
