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

            <section class="section" style="margin-top: -20px;">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5 class="underline mt-30">Data Grafik Medical Check Up<small></small> 
                            </h5>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="form_resign">
                            <div class="form-group  ">
                                <label for="inputEmail3" class="col-sm-3 control-label"> Masukan
                                    Periode Pencarian <sup class="color-danger">*</sup></label>
                                <div class="col-sm-2">
                                    <input class="form-control input-sm" type="date" id="tglAwal" autocomplete="off" name="tglAwal" placeholder="ketik Kata Kunci disini">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control input-sm" type="date" id="tglAkhir" autocomplete="off" name="tglAkhir" placeholder="ketik Kata Kunci disini">
                                </div>
                            </div>
                            
                            <div class="form-group  ">
                                <label for="inputEmail3" class="col-sm-3 control-label"> Jenis Rekap <sup class="color-danger">*</sup></label>
                                <div class="col-sm-2">
                                    <select class="form-control js-example-basic-single"  name="JenisRekap" id="JenisRekap" >
                                        <option value="">-- Pilih --</option>
                                        <option value="KETERANGAN_KESEHATAN">Rekap Keterangan Kesehatan</option>
                                        <option value="DIAGNOSA_KERJA">Rekap Diagnosa Kerja</option>
                                        <option value="JENIS_KELAMIN">Rekap Jenis Kelamin</option>
                                        <option value="UMUR">Rekap Umur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  ">
                                <label for="inputEmail3" class="col-sm-3 control-label"> Jenis Penjamin <sup class="color-danger">*</sup></label>
                                <div class="col-sm-2">
                                    <select class="form-control js-example-basic-single"  name="TipePenjamin" id="TipePenjamin" onchange="getIDPenjamin()">
                                        <option value="">-- Pilih --</option>
                                        <option value="1">Pribadi</option>
                                        <option value="2">Asuransi</option>
                                        <option value="5">Jaminan Perusahaan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  ">
                                <label for="inputEmail3" class="col-sm-3 control-label"> Nama Jaminan <sup class="color-danger">*</sup></label>
                                <div class="col-sm-2">
                                     <select class="form-control js-example-basic-single" id="NamaPenjamin" name="NamaPenjamin">
                                     </select>
                                </div>
                            </div>
                        </form>
                        <div class="form-group  ">
                            <label for="inputEmail3" class="col-sm-3 control-label"></label>
                            <div class="col-sm-2">
                                <button type="button" name="caridata" id="caridata" class="btn btn-success btn-wide btn-rounded"><i class="fa fa-search"></i>Search</button>
                            </div>
                        </div>
                        
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>


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

        @include("main.mcu.section.modallistdocument")
        <script src="{{ URL::asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            $(document).ready(function () {    
                $(".preloader").fadeIn();   

                $(document).on('click', '#caridata', function () {
                    param = $("#JenisRekap").val()
                        getRekapKetKesehatan();
                });
            });
                                   

                function showReportMCUPDF() {
                var tglAwal = $("#tglAwal").val(); 
                var tglAkhir = $("#tglAkhir").val(); 
                    $('#tbl_arsip').DataTable().clear().destroy();
                  
                    $('#tbl_arsip').DataTable({
                        "ordering": false,
                        "ajax": {
                            "url": "/getRekapSDSbyPeriode",
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
                                    var html = '<font size="1"> ' + row.tglregistrasi + ' </font>  ';
                                    return html
                                }
                            },
                            // {
                            //     "render": function (data, type, row) {
                            //         var html = ""
                            //         // var html = '<button onclick=\'gohasillab("' +  row.NoRegistrasi + '")\' class="button btn-sm">Lab</button>&nbsp<button onclick=\'gohasilrad("' +  row.NoRegistrasi + '")\' class="button btn-sm">Radiologi</button>&nbsp<button onclick=\'gohasilmcu("' +  row.NoRegistrasi + '")\' class="button btn-sm">Hasil MCU</button>&nbsp<button onclick=\'goGenerate("' +  row.NoRegistrasi + '")\' class="button btn-sm">Generate Hasil</button>'
                            //         var html = ' <div class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i><span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" onclick=\'gohasillab("' +  row.NoRegistrasi + '")\'><i class="fa fa-undo"></i> Hasil Laboratorium</a></li><li><a href="#"  onclick=\'gohasilrad("' +  row.NoRegistrasi + '")\'><i class="fa fa-history"></i> Hasil Radiologi</a></li><li><a href="#" onclick=\'gohasilmcu("' +  row.NoRegistrasi + '")\'><i class="fa fa-check color-success"></i> Hasil MCU</a></li><li><a href="#" onclick=\'goGenerate("' +  row.NoRegistrasi + '")\'><i class="fa fa-close color-danger"></i> Generate Hasil</a></li></ul> </div>'
                            //         return html
                            //     }
                            // },
                        ],
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5'
            ]
                    });
                }   

async function getIDPenjamin() {
    try {
        const datagetNamaPenjamin = await getNamaPenjamin();
        updateUIgetNamaPasien(datagetNamaPenjamin);
    } catch (err) {
        toast(err, "error")
    }
}

function getNamaPenjamin() {
    var base_url = window.location.origin;
    let param = $("#TipePenjamin").val();
    let url = base_url + '/getNamaPenjamin/' + param;
    return fetch(url, {
        method: 'GET',
        headers: {   "Content-type": "application/x-www-form-urlencoded; charset=UTF-8" }
    })
        .then(response => {
            if (!response.ok) { throw new Error(response.statusText) }  return response.json();
    })
        .then(response => {
            if (response.status === "error") { throw new Error(response.message.errorInfo[2]);  } 
            else if (response.status === "warning") {  throw new Error(response.errorname);  }
            return response
    })
        .finally(() => {
            $("#NamaPenjamin").select2();
    })
}

function updateUIgetNamaPasien(datagetNamaPasien) {
    let responseApi = datagetNamaPasien; 
    if (responseApi !== null && responseApi !== undefined) {
        $("#NamaPenjamin").empty();
        var newRow = '<option value="">-- PILIH --</option';
        $("#NamaPenjamin").append(newRow);
        for (i = 0; i < responseApi.length; i++) {
            var newRow = '<option value="' + responseApi[i].ID + '">' + responseApi[i].NamaPerusahaan + '</option';
            $("#NamaPenjamin").append(newRow);
        }
    }
}


async function getRekapKetKesehatan(){
    try {
            const data = await gogetRekapKetKesehatan();
            updateUIgrafik(data);
        } catch (err) {
            toast(err, "error")
        }
}

async function gogetRekapKetKesehatan() {
    var base_url = window.location.origin;
    let JenisRekap = $("#JenisRekap").val();
    let TipePenjamin = $("#TipePenjamin").val();
    let NamaPenjamin = $("#NamaPenjamin").val();
    let tglAwal = $("#tglAwal").val();
    let tglAkhir = $("#tglAkhir").val();
    let url = base_url + '/getRekap/';
    return fetch(url, {
        method: 'POST',
        headers: {   "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content') },
        body: 'JenisRekap=' + JenisRekap
              + '&TipePenjamin=' + TipePenjamin 
              + '&NamaPenjamin=' + NamaPenjamin 
              + '&tglAwal=' + tglAwal 
              + '&tglAkhir=' + tglAkhir 
    })
        .then(response => {
            if (!response.ok) { throw new Error(response.statusText) }  return response.json();
    })
        .then(response => {
            if (response.status === "error") { throw new Error(response.message.errorInfo[2]);  } 
            else if (response.status === "warning") {  throw new Error(response.errorname);  }
            return response
    })
        .finally(() => {
    })
}

function updateUIgrafik(response){
    var label = [];
    var dataset = [];
    var arrayLength = response.length;
    for (var i = 0; i < arrayLength; i++) {
        label.push(response[i].label)
        dataset.push(response[i].dataset)
    }
    let chartStatus = Chart.getChart("myChart"); // <canvas> id
    if (chartStatus != undefined) {
    chartStatus.destroy();
    }
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: label,
        datasets: [{
            label: $("#JenisRekap").val(),
            data: dataset,
            borderWidth: 2
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
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