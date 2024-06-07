<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}">

        <title>MCU System - RS YARSI - Login</title>

        <!-- ========== COMMON STYLES ========== -->
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" media="screen" >
        <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" media="screen" >
        <link rel="stylesheet" href="{{ URL::asset('css/animate-css/animate.min.css') }}" media="screen" >

        <!-- ========== PAGE STYLES ========== -->
        <link rel="stylesheet" href="{{ URL::asset('css/icheck/skins/flat/blue.css') }}" >

        <!-- ========== THEME CSS ========== -->
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" media="screen" >

        <!-- ========== MODERNIZR ========== -->
        <script src="{{ URL::asset('js/modernizr/modernizr.min.js') }}"></script>
    </head>
    <body class="">
        @yield('container')

        <!-- ========== COMMON JS FILES ========== -->
        <script src="{{ URL::asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
        <script src="{{ URL::asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/pace/pace.min.js') }}"></script>
        <script src="{{ URL::asset('js/lobipanel/lobipanel.min.js') }}"></script>
        <script src="{{ URL::asset('js/iscroll/iscroll.js') }}"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="{{ URL::asset('js/icheck/icheck.min.js') }}"></script>

        <!-- ========== THEME JS ========== -->
        <script src="{{ URL::asset('js/main.js') }}"></script>
        <script>
            $(function(){
                $('input.flat-blue-style').iCheck({
                    checkboxClass: 'icheckbox_flat-blue'
                });
            });
         
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
