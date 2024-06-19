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
                                d.role = $("#role").val(); 
                                d.group_jaminan = $("#group_jaminan").val(); 
                                d.id_jaminan = $("#id_jaminan").val(); 
                            }
                        },
                        "columns": [
                            // {
                            //     "render": function (data, type, row) { // Tampilkan kolom aksi
                            //         var html = ""
                            //         var html = '<font size="1"> ' + row.ID + ' </font>  ';
                            //         return html
                            //     }
                            // },
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