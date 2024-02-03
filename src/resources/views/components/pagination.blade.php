<div class="text-center position-relative">
    <div class="d-inline-block">
        {!! $links !!}
    </div>

    @if ($showLimit)
        @php
            $queryString = request()->getQueryString();
            parse_str($queryString, $queryParams);
            unset($queryParams['limit']);
            unset($queryParams['page']);
            $queryParams = array_filter($queryParams, function ($value) {
                return $value !== null && $value !== '';
            });
            $newQueryString = http_build_query($queryParams);
        @endphp
        <div class="position-absolute top-0 end-0 d-none d-sm-block">
            <div class="input-group">
                <select name="limit" class="form-select"
                    onchange="window.location.href = `?limit=${this.value}{{ $newQueryString ? '&' . $newQueryString : '' }}`">
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
