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
    <script src="{{ asset('js/navigation.js') }}"></script>
    
    <!-- Croppic plugin -->
    <script src="{{ asset('plugins/croppic/croppic.js') }}"></script>

    <!-- Include the SCEditors JS -->
    <script src="{{ asset('plugins/sceditor/minified/sceditor.min.js') }}"></script>

    <!-- Include the BBCode or XHTML formats for SCEditor -->
    <script src="{{ asset('plugins/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('plugins/sceditor/minified/formats/xhtml.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app_default.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/posts.css') }}" rel="stylesheet">

    
    <!-- Croppic plugin CSS -->
    <link href="{{ asset('plugins/croppic/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/croppic/assets/css/croppic.css') }}" rel="stylesheet">

    <!-- Include the default theme for SCEditor -->
    <link href="{{ asset('plugins/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
    
</head>

<body>
    <div id="app">
        
        @include ('partials.navigation')

        <main>
            @yield('content')
        </main>

        @include ('partials.footer')

    </div>

    @yield('scripts')
</body>
</html>
