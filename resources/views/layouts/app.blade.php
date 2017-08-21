<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>WebCORE Platform</title>

    <meta name="author" content="kominfo.go.id">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('themes/default/assets/stylesheets/bootstrap.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/default/assets/stylesheets/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/default/assets/stylesheets/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/default/assets/stylesheets/colors/color1.css') }}" id="colors">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/default/assets/stylesheets/animate.css') }}">

    <!-- Date Picker -->
    <link href="{{ asset('vendor/adminlte/plugins/datepicker/datepicker3.css') }}" rel="stylesheet">

    <style>
        .page-title.parallax1 {
            margin-top: 65px;
        }
        .page-title.parallax1 .top-title {
            margin-top: -100px;
        }
        .page-title.parallax1 .top-title,
        .page-title.parallax5 .top-title,
        .flat-row .title-flat-row {
            text-align: center;
            margin-bottom: 35px;
        }
        .page-title.parallax1 .top-title .title,
        .page-title.parallax5 .top-title .title,
        .flat-row .title-flat-row .title {
            font-family: "Bitter", sans-serif;
            font-size: 28px;
            margin-bottom: 9px;
            color: #343434;
        }
        .page-title.parallax1 .top-title p,
        .page-title.parallax5 .top-title p {
            font-size: 18px;
            color: #343434;
        }
        .no-content h3 {
            font-size: 1.5em;
            margin-bottom: 30px;
        }
        .no-content h2 {
            font-size: 2em;
            margin-bottom: 15px;
        }
        .page-title {
            margin-bottom: 30px;
        }
        .page-title h2 {
            font-size: 2em;
        }
        .page-title h3 {
            font-size: 1.5em;
            margin-bottom: 0;
        }
        .panel-heading h3 {
            font-size: 1.3em;
        }
        .panel-heading h3 small {
            font-size: .7em;
            vertical-align: top;
            position: relative;
            left: 5px;
        }

        .inner-container {
            margin-bottom: 50px;
        }
        .inner-container h3 {
            margin-bottom: 15px;
            font-size: 2em;
        }
        .inner-submenu {
            margin-top: 30px;
            text-align: center;
        }
        .inner-submenu li {
            display: inline-block;
            padding: 0 15px;
            border-right: 1px solid #717171;
        }
        .inner-submenu li:last-child {
            border-right: none;
        }
        .inner-submenu li.active a {
            color: #179bd7;
        }

        .flat-button.style-v1 {
            color: white;
            padding: 12px 20px;
            height: 42px;
            line-height: 0;
            background-color: #179bd7;
            border-top: #179bd7;
            border-left: #179bd7;
            border-right: #179bd7;
            border-bottom: rgba(0,0,0,.25);
            box-shadow: inset 0 -3px 0 rgba(0,0,0,.25);
            text-transform: none;
        }
        .flat-button {
            display: inline-block;
            padding-top: 6px;
            font-size: 13px;
            line-height: 1.42857143;
            padding: 9px 20px;
            margin-right: 16px;
            transition: all .2s;
            border-radius: 3px;
            border: solid 2px #eaeaea;
        }
        a.flat-button {
            color: #3e3e3e;
            text-decoration: none;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
    </style>

    @yield('styles')

    <!--[if lt IE 9]>
        <script src="javascript/html5shiv.js"></script>
        <script src="javascript/respond.min.js"></script>
    <![endif]-->

</head>

<body class="header-sticky">

    <div class="boxed">

        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')

        <!-- Javascript -->
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/jquery.easing.js') }}"></script>
        
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/owl.carousel.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/parallax.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/jquery.tweet.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/jquery.matchHeight-min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/jquery-validate.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/jquery-waypoints.js') }}"></script>

        <script src="{{ url('vendor/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
        
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/jquery.cookie.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themes/default/assets/javascript/main.js') }}"></script>

        <script>
            $(".date").datepicker({
                format:	'yyyy-mm-dd'
            });
        </script>

        @yield('scripts')
    </div>
</body>
</html>