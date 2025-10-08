<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Authentication') | {{ config('app.name') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Custom Auth Styles -->
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
            url('{{ asset('assets/img/events/showcase-1.webp') }}') center/cover no-repeat;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            font-family: 'Rubik', sans-serif;
            height: 100vh;
            /* color: #fff; */
        }

        .auth-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 2rem;
        }

        .auth-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }

        .auth-left {
            background: url('{{ asset('assets/img/events/showcase-1.webp') }}') center/cover no-repeat;
            min-height: 400px;
        }

        .auth-right {
            padding: 2.5rem;
        }

        .auth-right h2 {
            font-weight: 700;
            color: #0d6efd;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .auth-left {
                display: none;
            }

            .auth-right {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card row g-0">
            <div class="col-md-6 auth-left"></div>

            <div class="col-md-6 auth-right">
                <div class="text-center mb-4">
                    <h2>{{ config('app.name') }}</h2>
                    <p class="text-muted">@yield('subtitle')</p>
                </div>

                {{-- Page-specific content --}}
                @yield('content')

                <div class="text-center mt-4">
                    @yield('auth-links')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>