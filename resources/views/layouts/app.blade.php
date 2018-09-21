<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Posts') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script src="{{ asset('plugins/croppic/croppic.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/> --}}

    <link href="{{ asset('plugins/croppic/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/croppic/assets/css/croppic.css') }}" rel="stylesheet">
    
</head>

<body>
    <div id="app">
        
        @include ('partials.navigation')

        <main>
            @yield('content')
        </main>

        @include ('partials.footer')

    </div>
</body>
</html>
