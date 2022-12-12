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
    {{-- <link href="{{ asset('assets/adminpanel/template/vendor/font-awesome-5/css/fontawesome-all.min.css') }}"
        rel="stylesheet" media="all"> --}}
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
    <link
        href="{{ asset('assets/adminpanel/template/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.cs') }}s"
        rel="stylesheet" media="all">
    <link href="{{ asset('assets/adminpanel/template/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/adminpanel/template/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('assets/adminpanel/template/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/adminpanel/template/vendor/select2/select2.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('assets/adminpanel/template/vendor/perfect-scrollbar/perfect-scrollbar.css') }}"
        rel="stylesheet" media="all">

    <!-- Main CSS-->
    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('assets/adminpanel/template/css/theme-rtl.css') }}" rel="stylesheet" media="all">
    @else
        <link href="{{ asset('assets/adminpanel/template/css/theme.css') }}" rel="stylesheet" media="all">
    @endif


    <link rel="stylesheet" href="{{asset('assets/adminpanel/custom/plugins/toastr/toastr.css')}}">

    <!-- Custom CSS-->
    <link href="{{ asset('assets/adminpanel/custom/css/theme.css') }}" rel="stylesheet" media="all">

    @stack('styles')
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            @include('includes.sidebar')
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img width="55" src="{{ asset('assets/common/img/human-resources.png') }}"
                                        alt="{{ env('APP_NAME') }}" />
                                </a>
                            </div>

                            <div>
                                <h3 class="title-5 text-white">@yield('title')</h3>
                            </div>

                            <div class="header-button2">
                                {{-- <div class="header-button-item js-item-menu">
                                    <i class="zmdi zmdi-search"></i>
                                    <div class="search-dropdown js-dropdown">
                                        <form action="">
                                            <input class="au-input au-input--full au-input--h65" type="text"
                                                placeholder="Search for datas &amp; reports..." />
                                            <span class="search-dropdown__icon">
                                                <i class="zmdi zmdi-search"></i>
                                            </span>
                                        </form>
                                    </div>
                                </div> --}}

                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-money-box"></i>Billing</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-globe"></i>Language</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-pin"></i>Location</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-email"></i>Email</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-notifications"></i>Notifications</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>



            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                @include('includes.sidebar')
            </aside>
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            @if (Route::currentRouteName() == 'home')
                                                <li class="list-inline-item active">
                                                    <a href="{{route('home')}}">@lang('routes.home')</a>
                                                </li>
                                            @elseif (Str::contains(Route::currentRouteName(), 'index'))
                                                <li class="list-inline-item active">
                                                    <a href="{{route('home')}}">@lang('routes.home')</a>
                                                </li>
                                                <li class="list-inline-item seprate">
                                                    <span>/</span>
                                                </li>
                                                <li class="list-inline-item">@lang('routes.' . Route::currentRouteName())</li>
                                            @else
                                                <li class="list-inline-item active">
                                                    <a href="{{route('home')}}">@lang('routes.home')</a>
                                                </li>
                                                <li class="list-inline-item seprate">
                                                    <span>/</span>
                                                </li>
                                                <li class="list-inline-item"><a
                                                        href="{{ route(Str::replaceLast(Arr::last(explode('.' , Route::currentRouteName())) , 'index' , Route::currentRouteName() )) }}">{{  __('routes.' . Str::replaceLast(Arr::last(explode('.' , Route::currentRouteName())) , 'index' , Route::currentRouteName() )) }}</a>
                                                </li>

                                                <li class="list-inline-item seprate">
                                                    <span>/</span>
                                                </li>
                                                <li class="list-inline-item">@lang('routes.' . Route::currentRouteName())</li>
                                            @endif
                                        </ul>
                                    </div>

                                    @stack('actions')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <section>
                @include('includes.status')
            </section>

            @yield('content')

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a
                                        href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->
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
    <script src="{{ asset('assets/adminpanel/template/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('assets/adminpanel/template/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/adminpanel/template/vendor/select2/select2.min.js') }}"></script>

    <script src="{{ asset('assets/adminpanel/custom/plugins/toastr/toastr.min.js') }}"></script>

    <!-- table library -->
    {{-- <script src="{{ asset('assets/adminpanel/custom/js/larafy-table.js') }}"></script> --}}
    {{-- @include('includes.larafy-table') --}}

    <!-- Main JS-->
    <script src="{{ asset('assets/adminpanel/template/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
<!-- end document-->
