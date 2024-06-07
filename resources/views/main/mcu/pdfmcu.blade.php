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
                @include("main.mcu.mcusection")


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
        <script>
            $(document).ready(function () {    
                getTablesData();
                $(".preloader").fadeIn();   
                $('#upload_form').on('submit', function(event){
                    event.preventDefault();
                    $.ajax({
                    url:"/uploadPDFMCU",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        if(data.class_name == "alert-success"){
                            
                            var xnoregistrasi = $("#noregistrasi").val(); 
                            toast(data.message,"success");
                            getTablesData(xnoregistrasi);
                        }else{
                            toast(data.message,"error");
                        }
                        $(".preloader").fadeOut();  
                        // $('#message').css('display', 'block');
                        // $('#message').html(data.message);
                        // $('#message').addClass(data.class_name);
                        // $('#uploaded_image').html(data.uploaded_image);
                    }
                    })
                });
            });
                                    function gohasillab(noregistrasi) {
                                        window.open('/pdfviewhasillab/'+noregistrasi, '_blank'); 
                                    }
                                    function gohasilrad(noregistrasi) { 
                                        window.open('/pdfviewhasilradiologi/'+noregistrasi, '_blank'); 
                                    }
                                    function gohasilmcu(noregistrasi) { 
                                        window.open('/pdfviewhasilmcu/'+noregistrasi, '_blank'); 
                                    }
                                    function goGenerate(noregistrasi) {
                                        var confm = confirm('Apakah Anda Yakin ?');
                                            if (confm == true) { 
                                                generate(noregistrasi);
                                            }
                                    }
        
                                    async function generate(noregistrasi){
                                        try{
                                            $(".preloader").fadeIn();
                                            const data= await gogetgeneratelab(noregistrasi); 
                                            const data2= await gogetgeneraterad(noregistrasi); 
                                            const data3= await gogetgeneratehasilmcu(noregistrasi);  
                                            const data4= await gogetgeneratehasilmcusuketkesehatanjiwa(noregistrasi);  
                                            const data5= await gogetgeneratehasilmcusuketbebasnarkoba(noregistrasi);  
                                            const data6= await gogetgeneratehasilmcupemeriksaantreadmill(noregistrasi);  
                                            updategogetgeneratelab(data);
                                            updategogetgeneraterad(data2);
                                            updategogetgeneratehasilmcusuketkesehatanjiwa(data4);
                                            updategogetgeneratehasilmcusuketbebasnarkoba(data4);
                                            updategogetgeneratehasilmcupemeriksaantreadmill(data6);
                                            updategogetgeneratehasilmcu(data3,noregistrasi); 
                                        } catch (err) {
                                            console.log(err);
                                        }
                                    }
                                    async function merge(){
                                        try{
                                           $(".preloader").fadeIn();
                                            var noregistrasi =    $("#noregistrasi").val(); ; 
                                            const data4= await gomergePdf(noregistrasi); 
                                            updategomergePdf(data4);  
                                        } catch (err) {
                                            console.log(err);
                                            
                                        }
                                    }
                                function updategogetgeneratehasilmcusuketkesehatanjiwa(response){
                                        toast(response.message,"success"); 
                                }
                                function updategogetgeneratehasilmcusuketbebasnarkoba(response){
                                        toast(response.message,"success"); 
                                }
                                function updategogetgeneratehasilmcupemeriksaantreadmill(response){
                                        toast(response.message,"success"); 
                                }
                                function gogetgeneratehasilmcupemeriksaantreadmill(param){
                                    var base_url = window.location.origin;
                                    let url = base_url + '/savePemeriksaanTreadmill/' + param;
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
                                    })
                                }
                                function gogetgeneratehasilmcusuketbebasnarkoba(param){
                                    var base_url = window.location.origin;
                                    let url = base_url + '/saveBebasNarkoba/' + param;
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
                                    })
                                }
                                function gogetgeneratehasilmcusuketkesehatanjiwa(param){
                                    var base_url = window.location.origin;
                                    let url = base_url + '/saveSuketJiwa/' + param;
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
                                    })
                                }
                                
                                function updategogetgeneratelab(response){
                                        toast(response.message,"success");
                                      //  alert(response.status,response2.status,response3.status)
                                        //$(".preloader").fadeOut();
                                }
                                function updategogetgeneraterad(response){
                                      //  alert(response.status,response2.status,response3.status)
                                        toast(response.message,"success");
                                       // $(".preloader").fadeOut();
                                }
                                function updategogetgeneratehasilmcu(response,noregistrasi){
                                        $(".preloader").fadeOut();
                                        $('#modalcariDataMRSave').modal('show');
                                        $("#noregistrasi").val(noregistrasi); 
                                        getTablesData(noregistrasi);
                                        //alert(response.status,response2.status,response3.status)
                                        toast(response.message,"success");
                                      //  $(".preloader").fadeOut();
                                }
                                function updategomergePdf(response){
                                    //    alert(response.status,response2.status,response3.status)
                                        toast(response.message,"success"); 
                                        $('#modalcariDataMRSave').modal('hide');
                                        $(".preloader").fadeOut();
                                }
                                function gomergePdf(param){
                                    var base_url = window.location.origin;
                                    let url = base_url + '/mergehasilmcu/' + param;
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
                                    })
                                }
                                
                                function gogetgeneratelab(param){
                                    var base_url = window.location.origin;
                                    let url = base_url + '/pdfsavehasillab/' + param;
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
                                    })
                                }
                                function gogetgeneraterad(param){
                                    var base_url = window.location.origin;
                                    let url = base_url + '/pdfsavehasilradiologi/' + param;
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
                                    })
                                }
                                function gogetgeneratehasilmcu(param){
                                    var base_url = window.location.origin;
                                    let url = base_url + '/pdfsavehasilmcu/' + param;
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
                                    })
                                }
               // table
               function getTablesData(noreg) {
                     
                    $('#tableida').DataTable().clear().destroy();
                  
                    $('#tableida').DataTable({
                        "ordering": false,
                        "ajax": {
                            "url": "/listDocumentMCU",
                            "dataSrc": "",
                            "deferRender": true,
                            "type": "POST",
                            data: function (d) {
                                d.NoRegistrasi = noreg;
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
                                    var html = '<font size="1"> ' + row.KelompokHasil + ' </font>  ';
                                    return html
                                }
                            }, 
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.Url_Pdf_Local + ' </font>  ';
                                    return html
                                }
                            }, 
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.NoUrut + ' </font>  ';
                                    return html
                                }
                            }, 
                        ]
                    });
                }      
                
                

                function showReportMCUPDF() {
                var tglAwal = $("#tglAwal").val(); 
                var tglAkhir = $("#tglAkhir").val(); 
                    $('#tbl_arsip').DataTable().clear().destroy();
                  
                    $('#tbl_arsip').DataTable({
                        "ordering": false,
                        "ajax": {
                            "url": "/getRegistrationMCUbyDate",
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
                                    var html = '<font size="1"> ' + row.PatientName + ' </font>  ';
                                    return html
                                }
                            }, 
                            {
                                "render": function (data, type, row) { // Tampilkan kolom aksi
                                    var html = ""
                                    var html = '<font size="1"> ' + row.VisitDate + ' </font>  ';
                                    return html
                                }
                            },  
                            {
                                "render": function (data, type, row) {
                                    var html = ""
                                    // var html = '<button onclick=\'gohasillab("' +  row.NoRegistrasi + '")\' class="button btn-sm">Lab</button>&nbsp<button onclick=\'gohasilrad("' +  row.NoRegistrasi + '")\' class="button btn-sm">Radiologi</button>&nbsp<button onclick=\'gohasilmcu("' +  row.NoRegistrasi + '")\' class="button btn-sm">Hasil MCU</button>&nbsp<button onclick=\'goGenerate("' +  row.NoRegistrasi + '")\' class="button btn-sm">Generate Hasil</button>'
                                    var html = ' <div class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i><span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" onclick=\'gohasillab("' +  row.NoRegistrasi + '")\'><i class="fa fa-undo"></i> Hasil Laboratorium</a></li><li><a href="#"  onclick=\'gohasilrad("' +  row.NoRegistrasi + '")\'><i class="fa fa-history"></i> Hasil Radiologi</a></li><li><a href="#" onclick=\'gohasilmcu("' +  row.NoRegistrasi + '")\'><i class="fa fa-check color-success"></i> Hasil MCU</a></li><li><a href="#" onclick=\'goGenerate("' +  row.NoRegistrasi + '")\'><i class="fa fa-close color-danger"></i> Generate Hasil</a></li></ul> </div>'
                                    return html
                                }
                            },
                        ]
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