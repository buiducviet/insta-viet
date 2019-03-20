<!DOCTYPE html>
<!--[if IE 9]>
<html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ \App\Helper::media(MetaTag::get('icon')) }}">
        <link rel="apple-touch-icon" sizes="57x57" href="/img/icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/icons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/icons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/icons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/icons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/icons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/icons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/icons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/icons/apple-icon-180x180.png">
        <meta name="msapplication-TileImage" content="/img/icons/apple-icon-144x144.png">
        <meta name="msapplication-TileColor" content="#3d566e">
        <!-- END Icons -->
        <title>{!! MetaTag::get('title') !!}</title>
        <meta name="description" content="{!! MetaTag::get('description') !!}">
        <meta name="keywords" content="{!! MetaTag::get('keywords') !!}">
        <link rel="image_src" href="{{ \App\Helper::media(MetaTag::get('image_src')) }}">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta property="og:type" content="article">
        <meta property="og:title" content="{!! MetaTag::get('title') !!}">
        <meta property="og:description" content="{!! MetaTag::get('description') !!}">
        <meta property="og:url" content="{!! url()->current() !!}">
        <meta property="og:site_name" content="{!! MetaTag::get('title') !!}">
        <meta property="fb:app_id" content="{!! MetaTag::get('fb_app_id') !!}">
        <meta property="fb:admins" content="{!! MetaTag::get('fb_admin') !!}">
        <meta property="og:image" content="{{ \App\Helper::media(MetaTag::get('image_src')) }}">
        <meta property="og:image:width" content="480">
        <meta property="og:image:height" content="360">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:description" content="{{ MetaTag::get('description') }}">
        <meta name="twitter:title" content="{{ MetaTag::get('title') }}">
        <meta name="twitter:image" content="{{ \App\Helper::media(MetaTag::get('image_src')) }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="{{ MetaTag::get('robots') }}">
        <meta content="{{ MetaTag::get('robots') }}" name="googlebot">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="/css/main.css?v=1.1">

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="/css/themes.css">

        <link rel="stylesheet" href="/vendor/owlcarousel/owl.carousel.min.css">
        <link rel="stylesheet" href="/vendor/owlcarousel/owl.theme.default.min.css">
        <!-- END Stylesheets -->
        
        <!-- Modernizr (browser feature detection library) -->
        <script src="/js/vendor/modernizr.min.js"></script>
        <script type="text/javascript">
            window.Laravel = {!! json_encode([
                'routes' => config('config.routes'),
                'domain' => config('config.domain'),
            ]) !!}
        </script>
    </head>
    <body>
        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!-- 'boxed' class for a boxed layout -->
        <div id="page-container">
            <!-- Site Header -->
            @include('blocks.header')
            <!-- END Site Header -->
            @yield('content')

            <!-- Footer -->
            @include('blocks.footer')
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-up"></i></a>

        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="/js/vendor/jquery.min.js"></script>
        <script src="/js/vendor/bootstrap.min.js"></script>
        <script src="/js/plugins.js"></script>
        <script src="/vendor/owlcarousel/owl.carousel.min.js"></script>
        <script src="/js/app.js"></script>

        {!! config('config.ads.pop_all') !!}
        <!-- Load and execute javascript code used only in this page -->
        <script src="/js/pages/portfolio.js"></script>
        <script>$(function(){ Portfolio.init(); });</script>
        <script src="{{ mix('js/vue.js') }}"></script>
    </body>
</html>