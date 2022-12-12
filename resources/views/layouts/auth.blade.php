<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('assets/adminpanel/template/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/adminpanel/template/vendor/font-awesome-4.7/css/font-awesome.min.css') }}"
        rel="stylesheet" media="all">
    <link href="{{ asset('assets/adminpanel/template/vendor/font-awesome-5/css/fontawesome-all.min.css') }}"
        rel="stylesheet" media="all">
    <link href="{{ asset('assets/adminpanel/template/vendor/mdi-font/css/material-design-iconic-font.min.css') }}"
        rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('assets/adminpanel/template/vendor/bootstrap-4.1/bootstrap-rtl.min.css') }}"
            rel="stylesheet" media="all">
    @else
        <link href="{{ asset('assets/adminpanel/template/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet"
            media="all">
    @endif
    <!-- Vendor CSS-->
    <link href="{{ asset('assets/adminpanel/template/vendor/animsition/animsition.min.css') }}" rel="stylesheet"
        media="all">
    {{-- <link
        href="{{ asset('assets/adminpanel/template/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.cs') }}s"
        rel="stylesheet" media="all"> --}}
    <link href="{{ asset('assets/adminpanel/template/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    {{-- <link href="{{ asset('assets/adminpanel/template/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet"
        media="all"> --}}
    <link href="{{ asset('assets/adminpanel/template/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    {{-- <link href="{{ asset('assets/adminpanel/template/vendor/select2/select2.min.css') }}" rel="stylesheet"
        media="all"> --}}
    <link href="{{ asset('assets/adminpanel/template/vendor/perfect-scrollbar/perfect-scrollbar.css') }}"
        rel="stylesheet" media="all">

    <!-- Main CSS-->
    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('assets/adminpanel/template/css/theme-rtl.css') }}" rel="stylesheet" media="all">
    @else
        <link href="{{ asset('assets/adminpanel/template/css/theme.css') }}" rel="stylesheet" media="all">
    @endif

    <!-- Custom CSS-->
    <link href="{{ asset('assets/adminpanel/custom/css/theme.css') }}" rel="stylesheet" media="all">

    @stack('styles')
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                @yield('content')
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('assets/adminpanel/template/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('assets/adminpanel/template/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('assets/adminpanel/template/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/animsition/animsition.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/adminpanel/template/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('assets/adminpanel/template/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/counter-up/jquery.counterup.min.js') }}"></script> --}}
    <script src="{{ asset('assets/adminpanel/template/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    {{-- <script src="{{ asset('assets/adminpanel/template/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/select2/select2.min.js') }}"></script> --}}

    <!-- Main JS-->
    <script src="{{ asset('assets/adminpanel/template/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
<!-- end document-->
