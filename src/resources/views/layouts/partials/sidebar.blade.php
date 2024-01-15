<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='{{ route('admin.dashboard') }}'>
            <span class="align-middle">VN Welcome</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header"></li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='{{ route('admin.dashboard') }}'>
                    <i class="align-middle" data-feather="home"></i>
                    <span class="align-middle">Bảng điều khiển</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='/pages-profile'>
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Quản lý danh mục</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='/pages-sign-in'>
                    <i class="align-middle" data-feather="book"></i>
                    <span class="align-middle">Quản lý bài viết</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='/pages-sign-in'>
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Cài đặt tài khoản</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
