<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title>{{ config('config.admin_title') }}</title>

        <meta name="description" content="Website system manage.">
        <meta name="author" content="static">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{asset('themes/admin/css/bootstrap.min.css')}}">
        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{asset('themes/admin/css/plugins.css')}}">
        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{asset('themes/admin/css/main.css')}}">
        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="/themes/admin/css/themes.css">
        <link rel="stylesheet" href="{{asset('themes/admin/css/fileuploader.css') }}">
        <!-- Froala editor -->
        <link href="{{asset('themes/admin/vendor/froala/css/froala_editor.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('themes/admin/vendor/froala/css/froala_style.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Include Editor Plugins style. -->
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/char_counter.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/code_view.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/colors.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/emoticons.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/file.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/fullscreen.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/image.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/image_manager.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/line_breaker.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/quick_insert.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/table.css')}}">
        <link rel="stylesheet" href="{{asset('themes/admin/vendor/froala/css/plugins/video.css')}}">
        <!-- END Stylesheets -->
        <style type="text/css">
            #vueApp{
                min-height: 500px;
            }
        </style>
        <script>
            window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
        </script>
        @include('admin.block.header-js')
    </head>
    <body>
        <div id="page-wrapper">
            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations enable-cookies">
                <!-- Main Sidebar -->
                @include('admin.layouts.sidebar')
                <!-- END Main Sidebar -->

                <!-- Main Container -->
                <div id="main-container">
                    <!-- Header -->
                    @include('admin.layouts.main-container-header')
                    <!-- END Header -->

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Dashboard 2 Content -->
                        @section('content')
                        @show
                        <!-- END Dashboard 2 Content -->
                    </div>
                    <!-- END Page Content -->

                    <!-- Footer -->
                    <!-- END Footer -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

        <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
        @include('admin.modal.user-settings')
        <!-- END User Settings -->

        <!-- Remember to include excanvas for IE8 chart support -->
        <!--[if IE 8]><script src="{{asset('themes/admin/js/helpers/excanvas.min.js')}}"></script><![endif]-->

        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="{{asset('themes/admin/js/plugins.js')}}"></script>
        <script src="{{asset('themes/admin/js/helpers/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('themes/admin/js/app.js')}}?v=1.1"></script>
        <!-- Load and execute javascript code used only in this page -->
        @include('admin.layouts.load-custom-page-js')
    </body>
</html>