<html>
    <head>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/parsley.js"></script>
        <script src="/js/bootstrap-datepicker.min.js"></script>

        <script language="javascript">
            $('.dropdown-toggle').dropdown();
            $('.dropdown-menu').find('form').click(function (e) {
                e.stopPropagation();
            });
        </script>

        @yield("extraJavascript")


        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/all.css">
        <link rel="stylesheet" href="/css/parsley.css">
        <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="/css/branding.css">
        @yield("extraCss")
    </head>

    <body>
    <div class="container">
        <div class="row">
            @include('parts.header')
        </div>

        <div class="row">
            @yield('body_content')
        </div>

        <div class="row">
            @include('parts.footer')
        </div>
    </div>
    </body>
</html>
