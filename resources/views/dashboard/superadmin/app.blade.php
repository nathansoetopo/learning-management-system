<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title-superadmin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="{{ asset('dashboard') }}/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('dashboard') }}/assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/shared/iconly.css">

    <link rel="stylesheet"
        href="{{ asset('dashboard') }}/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/pages/datatables.css">

    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/toastify-js/src/toastify.css">

    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/sweetalert2/sweetalert2.min.css">
    @stack('superadminheadscript')
</head>

<body>
    <div id="app">
        @include('dashboard.superadmin.component.sidebar')

        @yield('content')
    </div>

    <script src="{{ asset('dashboard') }}/assets/js/bootstrap.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/app.js"></script>

    {{-- Jquery --}}
    <script src="{{ asset('dashboard') }}/assets/extensions/jquery/jquery.min.js"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('dashboard') }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/sweetalert2.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/dashboard.js"></script>
    <script src="{{ asset('dashboard') }}/assets/extensions/toastify-js/src/toastify.js"></script>
    @include('dashboard.parts.toast-danger')
    @include('dashboard.parts.toast-success')
    @stack('superadminscript')
</body>

</html>
