@include('layouts.dashboard._head')

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    @include('layouts.dashboard._header')

    @include('layouts.dashboard._aside')

    @yield('content')

    @include('partials._session')

    @include('layouts.dashboard._footer')

    @include('layouts.dashboard._footer_scripts')

</div><!-- end of wrapper -->


@stack('scripts')
</body>
</html>
