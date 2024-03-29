@extends('layouts.admin')

@section('page-title', 'Thêm danh mục')

@section('content')
    <form method="POST" action="{{ route('admin.category.store') }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <span class="text-danger">(*)</span>
                            <input type="text" name="category_name" value="{{ old('category_name') }}"
                                class="form-control" placeholder="Nhập tên danh mục">
                            @error('category_name')
                                <div class="mt-1 text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả danh mục</label>
                            <textarea name="category_description" class="form-control" rows="2">{{ old('category_description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Từ khóa danh mục</label>
                            <textarea name="category_keywords" class="form-control" rows="2">{{ old('category_keywords') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select class="form-select" name="parent_id">
                                <option value="">--- Mặc định ---</option>
                                @foreach ($categories as $category)
                                    <option {{ old('parent_id') == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary shadow">Thêm danh mục</button>
        </div>
    </form>
@endsection
