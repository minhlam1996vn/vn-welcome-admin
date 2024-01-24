<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='{{ route('admin.dashboard') }}'>
            <span class="sidebar-brand-text align-middle">
                VN Welcome
                <sup><small class="badge bg-primary text-uppercase">Admin</small></sup>
            </span>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src="https://demo.adminkit.io/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1"
                        alt="Charles Hall" />
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title" href="#">
                        Minh Lâm
                    </a>
                    <div class="sidebar-user-subtitle">Admin</div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                QUẢN TRỊ
            </li>
            <li class="sidebar-item {{ request()->segment(2) ? '' : 'active' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Trang tổng quan</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->segment(2) === 'category' ? 'active' : '' }}">
                <a data-bs-target="#category" data-bs-toggle="collapse"
                    class="sidebar-link {{ request()->segment(2) === 'category' ? '' : 'collapsed' }}">
                    <i class="align-middle" data-feather="list"></i>
                    <span class="align-middle">Danh mục</span>
                </a>
                <ul id="category"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->segment(2) === 'category' ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li
                        class="sidebar-item {{ request()->segment(2) === 'category' && !request()->segment(3) ? 'active' : '' }}">
                        <a class='sidebar-link' href="{{ route('admin.category.index') }}">Quản lý danh mục</a>
                    </li>
                    <li
                        class="sidebar-item {{ request()->segment(2) === 'category' && request()->segment(3) === 'create' ? 'active' : '' }}">
                        <a class='sidebar-link' href="{{ route('admin.category.create') }}">Thêm mới</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->segment(2) === 'article' ? 'active' : '' }}">
                <a data-bs-target="#article" data-bs-toggle="collapse"
                    class="sidebar-link {{ request()->segment(2) === 'article' ? '' : 'collapsed' }}">
                    <i class="align-middle" data-feather="layout"></i>
                    <span class="align-middle">Bài viết</span>
                </a>
                <ul id="article"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->segment(2) === 'article' ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li
                        class="sidebar-item {{ request()->segment(2) === 'article' && !request()->segment(3) ? 'active' : '' }}">
                        <a class='sidebar-link' href="{{ route('admin.article.index') }}">Quản lý bài viết</a>
                    </li>
                    <li
                        class="sidebar-item {{ request()->segment(2) === 'article' && request()->segment(3) === 'create' ? 'active' : '' }}">
                        <a class='sidebar-link' href="{{ route('admin.article.create') }}">Thêm mới</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->segment(2) === 'profile' ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.profile.index') }}">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Hồ sơ</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Báo cáo hàng tuần</strong>
                <div class="mb-3 text-sm">
                    Báo cáo bán hàng hàng tuần của bạn đã sẵn sàng để tải xuống!
                </div>

                <div class="d-grid">
                    <a href="#!" class="btn btn-outline-primary">
                        Tải xuống
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
