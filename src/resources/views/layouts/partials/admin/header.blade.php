<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item">
                <a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="maximize"></i>
                    </div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    {{ Auth::user()->name ?? 'Auth' }}
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class='dropdown-item' href='/pages-profile'>
                        <i class="align-middle me-1" data-feather="user"></i>
                        Profile
                    </a>
                    <a class='dropdown-item' href='/pages-settings'>
                        <i class="align-middle me-1" data-feather="settings"></i>
                        Settings & Privacy
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