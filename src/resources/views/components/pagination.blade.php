<div class="text-center position-relative">
    <div class="d-inline-block">
        <ul class="pagination flex-wrap mb-0">
            <li class="paginate_button page-item active">
                <a href="#" aria-controls="datatables-reponsive" aria-role="link" aria-current="page" data-dt-idx="0"
                    tabindex="0" class="page-link">
                    <- </a>
            </li>
            <li class="paginate_button page-item active"><a href="#" aria-controls="datatables-reponsive"
                    aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a>
            </li>
            <li class="paginate_button page-item "><a href="?page=1" aria-controls="datatables-reponsive"
                    aria-role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
            <li class="paginate_button page-item active">
                <a href="#" aria-controls="datatables-reponsive" aria-role="link" aria-current="page"
                    data-dt-idx="0" tabindex="0" class="page-link">
                    ->
                </a>
            </li>
        </ul>
    </div>

    @if ($showLimit)
        <div class="position-absolute top-0 end-0 d-none d-sm-block">
            <div class="input-group">
                <select name="limit" class="form-select" onchange="window.location.href = `?limit=${this.value}`">
                    <option value="">Hiển thị</option>
                    <option value="10" {{ request()->limit === '10' ? 'selected="selected"' : '' }}>10</option>
                    <option value="20" {{ request()->limit === '20' ? 'selected="selected"' : '' }}>20</option>
                    <option value="50" {{ request()->limit === '50' ? 'selected="selected"' : '' }}>50</option>
                    <option value="100" {{ request()->limit === '100' ? 'selected="selected"' : '' }}>100</option>
                    <option value="200" {{ request()->limit === '200' ? 'selected="selected"' : '' }}>200</option>
                </select>
            </div>
        </div>
    @endif
</div>
