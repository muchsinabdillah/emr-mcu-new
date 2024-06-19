<section class="section" style="margin-top: -20px;">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5 class="underline mt-30">Informasi PDF Reporting MCU<small></small> 
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
                                <div class="col-sm-2">
                                    <input class="form-control input-sm" type="hidden" id="role" readonly autocomplete="off" name="role" value="{{ Cookie::get('role') }}">
                                </div>
                                <input class="form-control input-sm" type="hidden" id="group_jaminan" readonly autocomplete="off" name="group_jaminan" value="{{ Cookie::get('group_jaminan') }}">
                                    <input class="form-control input-sm" type="hidden" id="id_jaminan" readonly autocomplete="off" name="id_jaminan" value="{{ Cookie::get('id_jaminan') }}">
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
                            <table id="tbl_arsip" width="100%" class="table table-striped table-hover cell-border">
                                <thead>
                                    <tr>
                                        <th style="display:none;">Visit Date</th>
                                        <th align='center'>
                                            <font size="1">No. Eposiode
                                        </th>
                                        <th align='center'>
                                            <font size="1">No. Registrasi
                                        </th>
                                        <th align='center'>
                                            <font size="1">No. MR
                                        </th>
                                        <th align='center'>
                                            <font size="1">Tgl Kunjungan
                                        </th>
                                        <th align='center'>
                                            <font size="1">PatientName
                                        </th>
                                        <th align='center'>
                                            <font size="1">Nama Jaminan
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