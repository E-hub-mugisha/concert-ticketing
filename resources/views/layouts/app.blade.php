<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | @yield('title')</title>
    <link href="{{ asset('/admin/vendor/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/vendor/fontawesome/css/solid.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/vendor/fontawesome/css/brands.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/css/master.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/vendor/flagiconcss/css/flag-icon.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body>

    <!-- Sidebar -->
    <div class="wrapper">
        @include('components.sidebar')
        <!-- Main content -->
        <div class="active" id="body">
            @include('components.topbar')
            <!-- Header -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartsjs/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard-charts.js') }}"></script>
    <script src="{{ asset('admin/js/script.js') }}"></script>
</body>

</html>