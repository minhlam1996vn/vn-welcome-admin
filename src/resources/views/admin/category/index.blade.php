@extends('layouts.admin')

@section('page-title', 'Quản lý danh mục')

@push('styles')
    <style>
        .list-group-item:hover {
            background-color: rgba(0, 0, 0, 0.1)
        }
    </style>
@endpush

@section('page-button')
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary float-end mt-n1">
        <i class="align-middle" data-feather="plus"></i>
        Thêm mới
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <div id="list-category" class="list-group col">
                            @forelse ($categoriesTree as $category)
                                <div data-id="{{ $category['id'] }}"
                                    class="list-group-item nested-1 border rounded shadow-lg mb-2 p-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="ms-1">
                                            <span class="text-info cursor-pointer">
                                                {{ $category['category_name'] }}
                                            </span>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.category.edit', $category['id']) }}"
                                                class="btn btn-sm btn-info rounded">
                                                <i class="align-middle" data-feather="edit"></i>
                                            </a>
                                            @if ($category['article_count'] === 0 && $category['category_children_count'] === 0)
                                                <form action="{{ route('admin.category.destroy', $category['id']) }}"
                                                    method="POST"class="d-inline-block">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger rounded">
                                                        <i class="align-middle" data-feather="trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    @if (isset($category['children']))
                                        <div class="list-group px-2 mt-2" id="list-sort-{{ $category['id'] }}">
                                            @foreach ($category['children'] as $categoryChildren)
                                                <div data-id="{{ $categoryChildren['id'] }}"
                                                    class="list-group-item nested-3 border rounded shadow-lg mb-2 p-2">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="ms-1">
                                                            <span class="text-secondary cursor-pointer">
                                                                {{ $categoryChildren['category_name'] }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('admin.category.edit', $categoryChildren['id']) }}"
                                                                class="btn btn-sm btn-secondary rounded">
                                                                <i class="align-middle" data-feather="edit"></i>
                                                            </a>
                                                            @if ($categoryChildren['article_count'] === 0)
                                                                <form
                                                                    action="{{ route('admin.category.destroy', $categoryChildren['id']) }}"
                                                                    method="POST"class="d-inline-block">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger rounded">
                                                                        <i class="align-middle" data-feather="trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center text-muted">Không có dữ liệu hiển thị</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($categoriesTree))
        <div class="text-center">
            <form method="POST" action="{{ route('admin.category.sort') }}">
                @csrf
                <textarea id="sort-value" class="d-none" name="sort_value"></textarea>
                <button id="get-order" class="btn btn-primary">Cập nhật vị trí</button>
            </form>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script>
        /* ---- SORTTABLE ---- */
        $('#list-category').sortable({
            group: {
                name: 'list',
                pull: 'clone',
                put: false,
            },
            animation: 200,
            onSort: reportActivity,
        });

        const categoriesId = "{{ collect($categoriesTree)->pluck('id') }}"
        const parseCategoriesId = JSON.parse(categoriesId);

        for (let i = 0; i < parseCategoriesId.length; i++) {
            $('#list-sort-' + parseCategoriesId[i]).sortable({
                group: {
                    name: 'list',
                    pull: 'clone',
                    put: false,
                },
                animation: 200,
                onSort: reportActivity,
            });
        }

        function reportActivity() {
            return
        };

        $('#get-order').click(function() {
            const sortValue = getNestedSortOrder('#list-category');
            $('#sort-value').val(JSON.stringify(sortValue));
        });

        function getNestedSortOrder(selector) {
            const result = [];

            $(selector).find('> .list-group-item').each(function() {
                const item = {
                    id: $(this).data('id'),
                    children: getNestedSortOrder($(this).find('.list-group'))
                };

                result.push(item);
            });

            return result;
        }
        /* ---- END SORTTABLE ---- */
    </script>
@endpush
