<div class="text-center position-relative">
    <div class="d-inline-block" style="min-height: 26px">
        @if ($links)
            {!! $links !!}
        @else
            <ul class="pagination">
                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true">‹</span>
                </li>
                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span>
                </li>
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">›</span>
                </li>
            </ul>
        @endif
    </div>

    @if ($showLimit)
        @php
            $queryString = getQueryStringCustom();
        @endphp
        <div class="position-absolute top-0 end-0 d-none d-sm-block">
            <div class="input-group">
                <select name="limit" class="form-select"
                    onchange="window.location.href = `?limit=${this.value}{{ $queryString ? '&' . $queryString : '' }}`">
                    <option value="">Hiển thị</option>
                    <option value="10" {{ request()->limit === '10' ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request()->limit === '20' ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request()->limit === '50' ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request()->limit === '100' ? 'selected' : '' }}>100</option>
                    <option value="200" {{ request()->limit === '200' ? 'selected' : '' }}>200</option>
                    <option value="500" {{ request()->limit === '500' ? 'selected' : '' }}>500</option>
                    <option value="1000" {{ request()->limit === '1000' ? 'selected' : '' }}>1000</option>
                </select>
            </div>
        </div>
    @endif
</div>
