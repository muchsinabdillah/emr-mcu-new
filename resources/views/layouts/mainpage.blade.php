<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MCU System - RS YARSI</title>

        <!-- ========== COMMON STYLES ========== -->
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" media="screen" >
        <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" media="screen" >
        <link rel="stylesheet" href="{{ URL::asset('css/animate-css/animate.min.css') }}" media="screen" >
        <link rel="stylesheet" href="{{ URL::asset('css/lobipanel/lobipanel.min.css') }}" media="screen" > 
        <!-- ========== PAGE STYLES ========== -->
        <link rel="stylesheet" href="{{ URL::asset('css/prism/prism.css') }}" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="{{ URL::asset('css/toastr/toastr.min.css') }}" media="screen" >
        <link rel="stylesheet" href="{{ URL::asset('css/icheck/skins/line/blue.css') }}" >
        <link rel="stylesheet" href="{{ URL::asset('css/icheck/skins/line/red.css') }}" >
        <link rel="stylesheet" href="{{ URL::asset('css/icheck/skins/line/green.css') }}" >
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ URL::asset('/css/select2/select2.min.css') }}" >
        
        <!-- ========== THEME CSS ========== -->
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" media="screen" >

        <!-- ========== MODERNIZR ========== -->
        <script src="{{ URL::asset('js/modernizr/modernizr.min.js') }}"></script>
        <style type="text/css">
            .preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background-color: #fff;
            }
    
            .preloader .loading {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                font: 14px arial;
            } 
        </style>
    </head>
    <div class="preloader">
        <div class="loading">
            <img src="{{ URL::asset('images/loading.gif') }}" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div>
    <body class="top-navbar-fixed"> 
        @yield('container') 
        <!-- ========== COMMON JS FILES ========== -->
        <script src="{{ URL::asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
        <script src="{{ URL::asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script> 
        <script src="{{ URL::asset('js/pace/pace.min.js') }}"></script>
        <script src="{{ URL::asset('js/lobipanel/lobipanel.min.js') }}"></script>
        <script src="{{ URL::asset('js/iscroll/iscroll.js') }}"></script>
       
        <!-- ========== PAGE JS FILES ========== -->
        <script src="{{ URL::asset('js/prism/prism.js') }}"></script>
        <script src="{{ URL::asset('js/waypoint/waypoints.min.js') }}"></script>
        <script src="{{ URL::asset('js/counterUp/jquery.counterup.min.js') }}"></script>
        <script src="{{ URL::asset('js/amcharts/amcharts.js') }}"></script>
        <script src="{{ URL::asset('js/amcharts/serial.js') }}"></script>
        <script src="{{ URL::asset('js/amcharts/plugins/export/export.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('js/amcharts/plugins/export/export.css') }}" type="text/css" media="all" />
        <script src="{{ URL::asset('js/amcharts/themes/light.js') }}"></script>
        <script src="{{ URL::asset('js/toastr/toastr.min.js') }}"></script>
        <script src="{{ URL::asset('js/icheck/icheck.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap-tour/bootstrap-tour.js') }}"></script>
        <!-- ========== THEME JS ========== -->
        <script src="{{ URL::asset('js/main.js') }}"></script>
        <script src="{{ URL::asset('js/traffic-chart.js') }}"></script>
        <script src="{{ URL::asset('js/task-list.js') }}"></script>
        <script src="{{ URL::asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ URL::asset('js/select2.min.js') }}"></script> 
        <!-- ===========Signature========== --> 
        <script src="{{ URL::asset('js/signature/numeric-1.2.6.min.js') }}"></script>
        <script src="{{ URL::asset('js/signature/bezier.js') }}"></script>
        <script src="{{ URL::asset('js/signature/jquery.signaturepad.js') }}"></script>
        <script src="{{ URL::asset('js/signature/html2canvas.js') }}" type='text/javascript'></script>
        <script src="{{ URL::asset('js/signature/json2.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/scroller/2.0.3/js/dataTables.scroller.min.js"></script>
        <script src="{{ URL::asset('js/DataTables/Checkboxes/dataTables.checkboxes.min.js') }}"></script>
        <script src="{{ URL::asset('js/select2/select2.js') }}"></script>
      
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
            $(document).ready(function () {   
                
                $(".preloader").fadeOut();
            });
                      
                  
                
        </script>
        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
