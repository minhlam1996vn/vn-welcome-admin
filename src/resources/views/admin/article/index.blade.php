@extends('layouts.admin')

@section('page-title', 'Quản lý bài viết')

@section('page-button')
    <a href="{{ route('admin.article.create') }}" class="btn btn-primary float-end mt-n1">
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
                                <select name="category_id" id="search-category" class="form-select">
                                    <option value="">Tất cả danh mục</option>
                                    {{ showCategories($categories, 0, null, request()->category_id) }}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="mb-3 d-flex align-items-center">
                            <label style="width: 100px" for="search-article" class="me-2">Bài viết</label>
                            <div class="w-100">
                                <input type="text" name="article_title" value="{{ request()->article_title }}"
                                    id="search-article" class="form-control" placeholder="Nhập tên bài viết tìm kiếm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="mb-3 d-flex align-items-center">
                            <label style="width: 100px" for="search-tag" class="me-2">Thẻ</label>
                            <div class="w-100">
                                <select name="tag_id" id="search-tag" class="form-select">
                                    <option value="">Tất cả các thẻ</option>
                                    @foreach ($tags as $tag)
                                        <option {{ $tag->id == request()->tag_id ? 'selected' : '' }}
                                            value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="mb-3 d-flex align-items-center">
                            <label style="width: 100px" for="search-status" class="me-2">Trạng thái</label>
                            <div class="w-100">
                                <select name="status" id="search-status" class="form-select">
                                    <option value="">Tất cả trạng thái</option>
                                    <option {{ request()->status == 1 ? 'selected' : '' }} value="1">
                                        Chưa xuất bản
                                    </option>
                                    <option {{ request()->status == 2 ? 'selected' : '' }} value="2">
                                        Đã xuất bản
                                    </option>
                                    <option {{ request()->status == 3 ? 'selected' : '' }} value="3">
                                        Tạm dừng
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
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

    <div class="mt-4">
        <x-pagination :links="$articles->onEachSide(0)->links()" :show-limit="true" />
    </div>

    <div class="d-flex justify-content-end mt-1 px-2">
        <span class="text-info">
            {{ $articles->firstItem() }} ~ {{ $articles->lastItem() }} / {{ $articles->total() }}
        </span>
    </div>

    <div class="card shadow-lg" style="border-top: 5px solid #3b7ddd; max-height: 60vh; overflow: auto">
        <div class="card-body min-vh-50">
            <table class="table table-responsive table-striped" style="min-width: 1000px">
                <thead>
                    <tr>
                        <th style="width: 10px" class="text-center">#</th>
                        <th style="width: 100px" class="text-center">Ảnh mô tả</th>
                        <th>Tên bài viết</th>
                        <th>Danh mục</th>
                        <th>Thẻ</th>
                        <th style="width: 110px" class="text-center">Ngày tạo</th>
                        <th style="width: 100px" class="text-center">Trạng thái</th>
                        <th style="width: 125px" class="text-center">Ngày xuất bản</th>
                        <th style="width: 100px"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $indexArticle => $article)
                        <tr>
                            <td class="text-center">
                                {{ $articles->firstItem() + $indexArticle }}
                            </td>
                            <td>
                                <div class="btn ratio ratio-16x9 overflow-hidden rounded-3 shadow" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="{{ $article->article_title }}">
                                    <img src="{{ $article->article_thumbnail ? Storage::url($article->article_thumbnail) : 'https://placehold.jp/1280x720.png' }}"
                                        alt="{{ $article->article_title }}" class="w-100 object-fit-cover">
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.article.show', $article->id) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Xem chi tiết">
                                    {{ Str::limit($article->article_title, 50, '...') }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.category.edit', $article->category->id) }}" class="text-info">
                                    {{ $article->category->category_name }}
                                </a>
                            </td>
                            <td>
                                @forelse ($article->tags as $tag)
                                    <a href="{{ route('admin.tag.edit', $tag->id) }}"
                                        class="btn btn-sm rounded-4 badge-primary-light my-1 text-nowrap">
                                        #{{ $tag->tag_name }}
                                    </a>
                                @empty
                                    <span>-</span>
                                @endforelse
                            </td>
                            <td class="text-center">
                                {{ Carbon\Carbon::parse($article->created_at)->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="text-center">
                                @if ($article->status === 1)
                                    <span class="badge badge-secondary-light">Chưa xuất bản</span>
                                @elseif($article->status === 2)
                                    <span class="badge badge-success-light">Đã xuất bản</span>
                                @else
                                    <span class="badge badge-danger-light">Tạm dừng</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $article->publication_date ? Carbon\Carbon::parse($article->publication_date)->format('d-m-Y H:i:s') : '-' }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.article.edit', $article->id) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Biên tập"
                                    class="btn btn-sm btn-secondary rounded">
                                    <i class="align-middle" data-feather="edit"></i>
                                </a>
                                <a href="" class="btn btn-sm btn-danger rounded" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Xoá">
                                    <i class="align-middle" data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                Không có dữ liệu hiển thị
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-pagination :links="$articles->onEachSide(0)->links()" :show-limit="false" />
@endsection
