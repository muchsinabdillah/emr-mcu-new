  <!-- Modal CARI MR-->
  <div class="modal fade" id="modalcariDataMRSave" tabindex="-1" role="dialog" style="overflow-y: auto" data-backdrop="static">
    <div class="modal-dialog  modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> List Data Document Report MCU</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <div class="col-sm-12">
                            <input type="hidden" name="totalrow" id="totalrow" class="form-control totalrow" />
                           
                            <div class="alert alert-success alert-dismissible">
                                <p> <strong>Info !</strong> Silahkan Upload File Hasil EKG, Treadmil dan Lainnya.
                                </p>
                                <p> <strong>Info !</strong> Silahkan Rubah urutan File Sebelum di Generate untuk di gabung.</p> 
                            </div>
                            <!-- tabel------------>
                            <form class="p-20" id="upload_form" method="post" id="upload_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name13">No. Register</label>
                                            <input type="text" class="form-control" id="noregistrasi" name="noregistrasi" required placeholder="No. Registrasi">
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username13">Jenis Document</label>
                                            <select class="js-states form-control" id="jenisdocument" required name="jenisdocument"> 
                                                  <option value="">-- PILIH --</option>
                                                  <option value="1">1. Hasil MCU</option>
                                                  <option value="2">2. Hasil Laboratorium</option> 
                                                  <option value="3">3. Hasil Radiologi</option>
                                                  <option value="4">4. Hasil EKG  ( 1. Foto Hasil, 2. Expertise )</option>
                                                  <option value="5">5. Hasil Treadmill  ( 1. Foto Hasil, 2. Expertise )</option>
                                                  <option value="6">6. Hasil Audiometri</option> 
                                                  <option value="7">7. Hasil Spirometri  ( 1. Foto Hasil, 2. Expertise )</option> 
                                                  <option value="8">8. Surat Keterangan Bebas Narkoba</option> 
                                                  <option value="9">9. Surat Keterangan Kesehatan Jiwa ( 1. Surat, 2. Lampiran )</option>  
                                              </select>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name13">Pilih File</label>
                                            <input type="file" name="select_file" id="select_file" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 --> 
                                </div> 
                                <button type="submit" class="btn bg-black btn-wide"  name="upload" id="upload" >Upload</button>
                            </form>
                            <span id="uploaded_image"></span>
                            <div class="alert" id="message" style="display: none"></div>
                            <br>
                            <div class="table-responsive">
                                <table class="display table table-striped table-bordered" id="tableida" width="100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <font size="1">ID</font>
                                            </th>
                                            <th>
                                                <font size="1">KATEGORY</font>
                                            </th>
                                            <th>
                                                <font size="1">NAMA FILE</font>
                                            </th>
                                            <th>
                                                <font size="1">NO. URUT</font>
                                            </th> 
                                        </tr>
                                    </thead>
                                 

                                </table>
                            </div>

                        </div><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="simapnMRx" name="simapnMRx" onclick="merge()">
                    <span class="glyphicon glyphicon-save"></span> PROSES PDF
                </button> 
            </div>
        </div>
    </div>
</div>
<!-- Modal CARI MR-->