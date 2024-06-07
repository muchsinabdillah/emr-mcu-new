@extends('layouts.mainpage')
@section('container')
<div class="main-wrapper">

    <!-- ========== TOP NAVBAR ========== -->
    @include('sections.headernavigation')

    <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
    <div class="content-wrapper">
        <div class="content-container">

            <!-- ========== LEFT SIDEBAR ========== -->
            @include('sections.sidenavigation')
            <!-- /.left-sidebar -->

        <!-- ========== MAIN  ========== -->
            
            <div class="main-page">
                
                <!-- /.container-fluid -->       
                @include("main.mcu.mcureportingpdf")


            </div>
 <!-- ========== MAIN  ========== -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
                    <!-- /.main-page -->
                    <div class="right-sidebar bg-white fixed-sidebar">
                        <div class="sidebar-content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Useful Sidebar <i class="fa fa-times close-icon"></i></h4>
                                        <p>Code for help is added within the main page. Check for code below the example.</p>
                                        <p>You can use this sidebar to help your end-users. You can enter any HTML in this sidebar.</p>
                                        <p>This sidebar can be a 'fixed to top' or you can unpin it to scroll with main page.</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div>
                                    <!-- /.col-md-12 -->

                                    <div class="text-center mt-20">
                                        <button type="button" class="btn btn-success btn-labeled">Purchase Now<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                    </div>
                                    <!-- /.text-center -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>
                    <!-- /.right-sidebar -->
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
           

        </div>
        <!-- /.main-wrapper -->  

      
        <script src="{{ URL::asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
        <script>
            $(document).ready(function () {    
              //  getTablesData();
            }); 
            function showReportMCUPDF() {
                var tglAwal = $("#tglAwal").val(); 
                var tglAkhir = $("#tglAkhir").val(); 
                    $('#tbl_arsip').DataTable().clear().destroy();
                  
                    $('#tbl_arsip').DataTable({
                        "ordering": false,
                        "ajax": {
                            "url": "/listDocumentMCUPDFReport",
                            "dataSrc": "",
                            "deferRender": true,
                            "type": "POST",
                            data: function (d) {
                                d.tglAwal = tglAwal;
                                d.tglAkhir = tglAkhir;
                                d._token = $('meta[name="csrf-token"]').attr('content'); 
                            }
                        },
                        "columns": [
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.ID + ' </font>  ';
                                    return html
                                }
                            },
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.NoEpisode + ' </font>  ';
                                    return html
                                }
                            }, 
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.NoRegistrasi + ' </font>  ';
                                    return html
                                }
                            }, 
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.NoMR + ' </font>  ';
                                    return html
                                }
                            }, 
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.TglKunjungan + ' </font>  ';
                                    return html
                                }
                            }, 
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.PatientName + ' </font>  ';
                                    return html
                                }
                            }, 
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.NamaJaminan + ' </font>  ';
                                    return html
                                }
                            },  
                            {
                                "render": function (data, type, row) {
                                    var html = ""
                                    var html = '<button type="button" class="btn btn-default border-primary btn-animated btn-xs" onclick=\'ViewPDF("' +  row.URL_PDF + '")\'><span class="visible-content" > View</span></button>'
                                    return html
                                }
                            },
                        ]
                    });
                }   
function ViewPDF(str) { 
    var win = window.open(str, '_blank');
    win.focus()
}
             
// Primary function always
function toast(data, status) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr[status](data);
}
</script>