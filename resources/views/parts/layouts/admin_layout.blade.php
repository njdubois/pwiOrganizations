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
        @yield("extraCss")
    </head>

    <body>
        @include('parts.header')

        @yield('body_content')

        @include('parts.footer')
    </body>
</html>
