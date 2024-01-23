<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/admin.css'])
</head>

<body>
    <div id="app" class="wrapper">
        @include('layouts.partials.sidebar')

        <div class="main">
            @include('layouts.partials.header')

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>VN Welcome</strong> Dashboard</h1>

                    <div>
                        @yield('content')
                    </div>
                </div>
            </main>

            <form id="logout-admin-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            @include('layouts.partials.footer')
        </div>

        @vite(['resources/js/admin.js'])
    </div>
</body>

</html>
