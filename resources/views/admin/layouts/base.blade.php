<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laravel 9 - AdminLTE - Learn laravel basic - laravel framework" />
    <meta name="author" content="Tuantq" />
    <!--  Essential META Tags -->
    <meta property="og:title" content="Laravel 9 - AdminLTE - Learn laravel basic - laravel framework" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ asset('assets/images/banner.jpg') }}" />
    <meta property="og:image" content="{{ asset('assets/images/banner.jpg') }}" />
    <meta name="twitter:card" content="learn_laravel_basic">
    <!--  Non-Essential, But Recommended -->
    <meta property="og:description" content="Laravel 9 - AdminLTE - Learn laravel basic - laravel framework">
    <meta property="og:site_name" content="Laravel 9 - AdminLTE - Learn laravel basic - laravel framework">
    <meta name="twitter:image:alt" content="learn_laravel_basic">
    <title>
        @if (isset($title))
            {{ __($title) }}
        @else
            {{ config('app.name', 'Administrator - Laravel 9') }}
        @endif
    </title>
    <!-- Pugins style -->
    @stack('css')
    <!-- Theme style -->
    @vite(['resources/css/app.css'])
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.layouts.partials.navbar')

        @include('admin.layouts.partials.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('admin.layouts.partials.control-sidebar')

        @include('admin.layouts.partials.footer')
    </div>
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

    @vite(['resources/js/app.js'])

    <!-- AdminLTE for plugins -->
    @stack('scripts')

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>

    <!-- popup show notifications -->
    @include('admin.layouts.partials.notification')
</body>

</html>
