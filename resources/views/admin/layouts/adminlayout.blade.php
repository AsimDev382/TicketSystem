<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.component.style')
        @yield('style')
    </head>
<body class="layout-4">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!-- Start app top navbar -->
        @include('admin.component.navbar')

        <!-- Start main left sidebar menu -->
        @include('admin.component.sidebar')


        @yield('main-content')

        </div>
    </div>

     <!-- Start app javascript part -->

     @yield('script')
    @include('admin.component.javascript')

</body>
</html>
