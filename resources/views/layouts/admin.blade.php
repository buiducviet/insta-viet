<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script type="text/javascript">
        window.Laravel = {!! json_encode([
            'auth' => \Auth::check()? \Auth::user(): null,
            'csrf_token' => csrf_token(),
            'media' => env('FTP_URL'),
        ]) !!};
    </script>

    <!-- BODY options, add following classes to body to change options

    // Header options
    1. '.header-fixed'                  - Fixed Header

    // Sidebar options
    1. '.sidebar-fixed'                 - Fixed Sidebar
    2. '.sidebar-hidden'                - Hidden Sidebar
    3. '.sidebar-off-canvas'        - Off Canvas Sidebar
    4. '.sidebar-compact'               - Compact Sidebar Navigation (Only icons)

    // Aside options
    1. '.aside-menu-fixed'          - Fixed Aside Menu
    2. '.aside-menu-hidden'         - Hidden Aside Menu
    3. '.aside-menu-off-canvas' - Off Canvas Aside Menu

    // Footer options
    1. '.footer-fixed'                      - Fixed footer

    -->
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app" ></div>
    <script src="{{ mix('js/admin.js') }}"></script>
</body>
</html>
