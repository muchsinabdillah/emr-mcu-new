<section class="section" style="margin-top: -20px;">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5 class="underline mt-30">Data Pasien Medical Check Up<small></small> 
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
                        </form>
                        <div class="form-group  ">
                            <label for="inputEmail3" class="col-sm-3 control-label"></label>
                            <div class="col-sm-2">
                                <button type="button" onclick="showReportMCUPDF();" id="caridatapasienarsip" class="btn btn-success btn-wide btn-rounded"><i class="fa fa-search"></i>Search</button>
                            </div>
                        </div>
                        
                        <div class="demo-table" width="100%" id="tbl_rekap" style="margin-top: 100px;overflow-x:auto;">
                            <table id="tbl_arsip" class="table table-striped table-hover cell-border">
                                <thead>
                                    <tr> 
                                        <th align='center'>
                                            <font size="1">NoEpisode
                                        </th>
                                        <th align='center'>
                                            <font size="1">NoRegistrasi
                                        </th>
                                        <th align='center'>
                                            <font size="1">NoMR
                                        </th>
                                        <th align='center'>
                                            <font size="1">Nama Pasien
                                        </th>
                                        <th align='center'>
                                            <font size="1">Tgl Kunjungan
                                        </th>  
                                        <th align='center'>
                                            <font size="1">Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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