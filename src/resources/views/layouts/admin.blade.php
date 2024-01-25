<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="VNWelcome">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="https://demo.adminkit.io/img/icons/icon-48x48.png" />

    <title>VN Welcome - Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://demo.adminkit.io/css/light.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/admin.css', 'resources/css/custom.css'])
    @stack('styles')
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        @include('layouts.partials.admin.sidebar')

        <div class="main">
            @include('layouts.partials.admin.header')

            <main class="content p-xl-4">
                <x-alert />

                <div class="container-fluid p-0">
                    <div class="row mt-3 mb-4">
                        <div class="col-auto">
                            <h3>
                                @yield('page-title')
                            </h3>
                        </div>

                        <div class="col-auto ms-auto mt-n1">
                            @yield('page-button')
                        </div>
                    </div>

                    @yield('content')

                </div>
            </main>

            <form id="logout-admin-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            @include('layouts.partials.admin.footer')
        </div>
    </div>

    @vite(['resources/js/admin.js'])
    @stack('scripts')
</body>

</html>
