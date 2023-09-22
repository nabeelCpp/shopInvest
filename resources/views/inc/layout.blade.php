@include('inc.head')
    <body>
        <!-- Navigation-->
            @include('inc.navbar')
        <!-- Header-->
            @if (isset($hero) && $hero)
                @include('inc.hero')
            @endif
        <!-- Section-->
            @yield('content')
        <!-- Footer-->
            @include('inc.footer')
        {{-- Scripts --}}
            @include('inc.scripts')

            @yield('js')
    </body>
</html>