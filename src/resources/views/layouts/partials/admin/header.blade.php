<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class='dropdown-item' href="{{ route('admin.profile.index') }}">
                        <i class="align-middle me-1" data-feather="user"></i>
                        Hồ sơ
                    </a>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" onclick="document.getElementById('logout-admin-form').submit()">
                        Đăng xuất
                    </button>
                </div>
            </li>
        </ul>
    </div>
</nav>
