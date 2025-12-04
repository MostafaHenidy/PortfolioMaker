<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Portfolio Builder</title>
    <link rel="stylesheet" href="{{ asset('front-assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('front-assets/icon.svg') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
</head>

<body class="{{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : '' }}">
    <div>
        <!-- Sidebar -->
        @include('dashboard.partials.sidebar')
        <!-- Main Content -->
        <div class="main-content" @if (LaravelLocalization::getCurrentLocale() == 'ar') dir="rtl" @endif>
            <div class="header">
                <h2> {{ __('keywords.dashboard') }} </h2>
                <div class="user-info">{{ __('keywords.logged in as:') }} <span>{{ auth()->user()->email }}</span>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
    @include('dashboard.partials.scripts')
</body>

</html>
