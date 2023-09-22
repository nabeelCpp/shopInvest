<!DOCTYPE html>
<html lang="en">
    @include('dashboard.inc.header')
    <body class="sb-nav-fixed">
        @include('dashboard.inc.nav')
        <div id="layoutSidenav">
            @include('dashboard.inc.sidebar')
            <div id="layoutSidenav_content">
                @yield('content')
                @include('dashboard.inc.footer')
            </div>
        </div>
        @include('dashboard.inc.scripts')
        @include('dashboard.inc.notifications')
        @yield('js')
    </body>
</html>