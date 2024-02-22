@extends('layouts.admin')

@section('page-title', 'Cập nhật danh mục')

@section('content')
    <form method="POST" action="{{ route('admin.category.update', $category->id) }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <span class="text-danger">(*)</span>
                            <input type="text" name="category_name"
                                value="{{ old('category_name') ?? $category->category_name }}" class="form-control"
                                placeholder="Nhập tên danh mục">
                            @error('category_name')
                                <div class="mt-1 text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả danh mục</label>
                            <textarea name="category_description" class="form-control" rows="2">{{ $category->category_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Từ khóa danh mục</label>
                            <textarea name="category_keywords" class="form-control" rows="2">{{ $category->category_keywords }}</textarea>
                        </div>
                        @if ($category->parent_id)
                            <div class="mb-3">
                                <label class="form-label">Danh mục cha</label>
                                <select class="form-select" name="parent_id">
                                    @foreach ($categories as $categoryItem)
                                        <option value="{{ $categoryItem->id }}"
                                            {{ $category->parent_id === $categoryItem->id ? 'selected' : '' }}>
                                            {{ $categoryItem->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary shadow">Cập nhật</button>
        </div>
    </form>
@endsection
