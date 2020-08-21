<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel='icon' href='img/logo.png' type='image/png' sizes='16x16'>

        <meta name="description" content="{{ config('app.name', 'Laravel') }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- style -->
        <!-- build:css {{ asset('/basik/assets/css/site.min.css') }} -->
        <link rel="stylesheet" href="{{ asset('/basik/assets/css/bootstrap.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/basik/assets/css/theme.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/basik/assets/css/style.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/css/admin.css') }}" type="text/css" />


        
        <!-- endbuild -->
    </head>
    <body class="layout-row">
        <!-- ############ Aside START-->
        @include('layouts.aside')
        <!-- ############ Aside END-->
        <div id="main" class="layout-column flex">
            <!-- ############ Header START-->
            @include('layouts.header')
            
            <!-- ############ Content START-->
            @yield('content')
            <!-- ############ Content END-->
            <!-- ############ Footer START-->
            @include('layouts.footer')
            <!-- ############ Footer END-->
        </div>
        <!-- build:js {{ asset('/basik/assets/js/site.min.js') }} -->
        <!-- jQuery -->
        <script src="{{ asset('/basik/libs/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('/basik/libs/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('/basik/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- ajax page -->
        <script src="{{ asset('/basik/libs/pjax/pjax.min.js') }}"></script>
        <script src="{{ asset('/basik/assets/js/ajax.js') }}"></script>
        <!-- lazyload plugin -->
        <script src="{{ asset('/basik/assets/js/lazyload.config.js') }}"></script>
        <script src="{{ asset('/basik/assets/js/lazyload.js') }}"></script>
        <script src="{{ asset('/basik/assets/js/plugin.js') }}"></script>
        <!-- scrollreveal -->
        <script src="{{ asset('/basik/libs/scrollreveal/dist/scrollreveal.min.js') }}"></script>
        <!-- feathericon -->
        <script src="{{ asset('/basik/libs/feather-icons/dist/feather.min.js') }}"></script>
        <script src="{{ asset('/basik/assets/js/plugins/feathericon.js') }}"></script>
        <!-- theme -->
        <script src="{{ asset('/basik/assets/js/theme.js') }}"></script>
        <script src="{{ asset('/basik/assets/js/utils.js') }}"></script>
        <!-- endbuild -->
    </body>
</html>
