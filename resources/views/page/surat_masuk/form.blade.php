<div id="pageSuratForm">
    <div style="margin-top: 20px; margin-left: 20px; margin-right: 20px;">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Transaksi Surat /</span>
            Surat {{$tipe_surat}} / <span class="font-weight-bold" id="label_header"></span>
        </h4>
        <div class="card mb-4">
            <form action="" method="POST" id="suratForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">
                    <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <input type="" hidden="" id="id_surat" name="id_surat">
                            <input type="hidden" value="{{$tipe_surat}}" name="tipe_surat" id="tipe_surat">
                            <label for="nomor_surat" class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                            <input type="text" required="" class="form-control nomor_surat" id="nomor_surat" name="nomor_surat" value="" />
                            <span class="error invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="pengirim" class="form-label">Pengirim <span class="text-danger">*</span></label>
                            <input type="text" required="" class="form-control pengirim" id="pengirim" name="pengirim" value="" />
                            <span class="error invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="tanggal_surat" class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                            <input type="date" required="" class="form-control tanggal_surat" id="tanggal_surat" name="tanggal_surat" value="" />
                            <span class="error invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="tanggal_terima" class="form-label">Tanggal Diterima <span class="text-danger">*</span></label>
                            <input type="date" required="" class="form-control tanggal_terima" id="tanggal_terima" name="tanggal_terima" value="" />
                            <span class="error invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                        <div class="mb-3">
                            <label for="ringkasan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control ringkasan" required="" id="ringkasan" name="ringkasan" rows="3"></textarea>
                            <span class="error invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                        <div>
                            <label for="disposisi" class="form-label">Disposisi</label>
                            <div class="input-group">
                                <select class="form-control select2 disposisi" style="width: 100%;" name="disposisi" id="disposisi">
                                    @foreach($anggota as $agt)
                                    <option value="{{$agt->id}}"> {{$agt->level}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="error invalid-feedback"></span>
                        </div>                        
                    </div>           
                    <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                        <div>
                            <label for="id_klasifikasi" class="form-label">Klasifikasi <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select class="form-control select2 id_klasifikasi" required="" style="width: 100%;" name="id_klasifikasi" id="id_klasifikasi">
                                    @foreach($klasifikasi as $kls)
                                    <option value="{{$kls->id_klasifikasi}}">{{$kls->nama_klasifikasi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="error invalid-feedback"></span>
                        </div>
                    </div>  
                    <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                        <div>
                            <label for="id_status" class="form-label">Status Surat <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select class="form-control select2 id_status" required="" style="width: 100%;" name="id_status" id="id_status">
                                    @foreach($status as $sts)
                                    <option value="{{$sts->id_status}}">{{$sts->nama_status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="error invalid-feedback"></span>
                        </div>
                    </div>   
                    <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="attachments" class="form-label">Lampiran <span class="text-danger" id="required_lampiran"></span></label>
                            <input type="file" class="form-control " id="lampiran"
                            name="lampiran"/>
                            <input type="" hidden="" id="lampiranLama" name="lampiranLama">
                            <span class="error invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12 col-md-6 col-lg-3">
                        <label></label>
                        <a href="javascript:void(0)" class="btn btn-info w-100 mt-2 lihat_berkas_scan_input"><i class="fa fa-eye"></i> Lihat Lampiran</a>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="card-footer pt-3">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        <button class="btn btn-secondary" type="button" id="back">Kembali</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade text-center modal_view_file_scan" data-bs-backdrop="static" id="modal_opsional" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title-view" id="myModalLabel1">Preview Lampiran</h5>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <embed src="" class="embed_scan" id="embed_scan" class="img-thumbnail" height="600" style="display: none;width: 100%;height: 800px;"></embed>
              </div>
          </div>
      </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
      <i class="bx bx-x d-block d-sm-none"></i>
      <span class="">Tutup</span>
  </button>
</div>
</div>
</div>
</div>
</div>