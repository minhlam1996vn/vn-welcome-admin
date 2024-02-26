@extends('layouts.admin')

@section('page-title', 'Quản lý tag')

@section('page-button')
    <a href="{{ route('admin.tag.create') }}" class="btn btn-primary float-end mt-n1">
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
                            <label style="width: 100px" for="search-article" class="me-2">Tên tag</label>
                            <div class="w-100">
                                <input type="text" name="tag_name" value="{{ $params['tag_name'] ?? null }}"
                                    id="search-article" class="form-control" placeholder="Nhập tên tag tìm kiếm">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
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
        <x-pagination :links="$tags->onEachSide(0)->links()" :show-limit="true" />
    </div>

    <div class="d-flex justify-content-end mt-1 px-2">
        <span class="text-info">
            {{ $tags->firstItem() }} ~ {{ $tags->lastItem() }} / {{ $tags->total() }}
        </span>
    </div>

    <div class="card shadow-lg" style="border-top: 5px solid #3b7ddd; max-height: 60vh; overflow: auto">
        <div class="card-body min-vh-50">
            <table class="table table-responsive table-striped" style="min-width: 710px">
                <thead>
                    <tr>
                        <th style="width: 10px" class="text-center">#</th>
                        <th style="width: 150px">Tên tag</th>
                        <th style="width: 150px" class="text-center">Số bài viết</th>
                        <th style="width: 150px" class="text-center">Ngày tạo</th>
                        <th style="width: 150px" class="text-center">Ngày cập nhật</th>
                        <th style="width: 100px"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tags as $indexTag => $tag)
                        <tr>
                            <td class="text-center">
                                {{ $tags->firstItem() + $indexTag }}
                            </td>
                            <td>
                                <a href="{{ route('admin.article.index', ['tag_id' => $tag->id]) }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $tag->tag_name }}">
                                    {{ Str::limit($tag->tag_name, 50, '...') }}
                                </a>
                            </td>
                            <td class="text-center">
                                {{ $tag->articles->count() }}
                            </td>
                            <td class="text-center">
                                {{ Carbon\Carbon::parse($tag->created_at)->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="text-center">
                                {{ Carbon\Carbon::parse($tag->updated_at)->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.tag.edit', $tag->id) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Chỉnh sửa"
                                    class="btn btn-sm btn-secondary rounded">
                                    <i class="align-middle" data-feather="edit"></i>
                                </a>
                                @if ($tag->articles->count() === 0)
                                    <form action="{{ route('admin.tag.destroy', $tag->id) }}"
                                        method="POST"class="d-inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger rounded">
                                            <i class="align-middle" data-feather="trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Không có dữ liệu hiển thị
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-pagination :links="$tags->onEachSide(0)->links()" :show-limit="false" />
@endsection
