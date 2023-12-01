<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
{{--    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">--}}
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{ env('APP_NAME') }} @yield('head_title', '')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <script src="https://cdn.tailwindcss.com"></script>


    @vite(['resources/sass/app.scss'])
</head>

<body class="font-sans antialiased only-frontend overflow-x-hidden">
    <div class="h-screen w-full flex overflow-hidden">
        @auth()
            @include('layouts.navs.auth')
        @else
            @include('layouts.navs.guest')
        @endauth
        <main
            class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition duration-500 ease-in-out overflow-y-auto pl-4">
            @include('components.flashMessages')

            @yield('content')

        </main>
    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


    @stack('scripts')
</body>

</html>
