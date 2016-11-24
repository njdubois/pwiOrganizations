<html>
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



        @yield("extraJavascript")


        {{--<link rel="stylesheet" href="/css/nav_bar.css">--}}
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/default_layout.css">
        @yield("extraCss")


        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>

        <script language="javascript">
            $('.dropdown-toggle').dropdown();
            $('.dropdown-menu').find('form').click(function (e) {
                e.stopPropagation();
            });
        </script>

    </head>

    <body>
        @include('parts.header')
        @yield('body_content')
        @include('parts.footer')
    </body>

</html>
