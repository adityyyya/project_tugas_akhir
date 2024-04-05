  <div class="modal fade" data-bs-backdrop="static" id="modal_view">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-7">
             <div class="row">
               <div class="col-3">Nomor Surat</div>
               <div class="col-1">:</div>
               <div class="col-8 nomor_surat"></div>
             </div>
             <div class="row">
               <div class="col-3">Pengirim</div>
               <div class="col-1">:</div>
               <div class="col-8 pengirim"></div>
             </div>
             <div class="row">
               <div class="col-3">Nomor Agenda</div>
               <div class="col-1">:</div>
               <div class="col-8 nomor_agenda"></div>
             </div>
             <div class="row">
               <div class="col-3">Tanggal Surat</div>
               <div class="col-1">:</div>
               <div class="col-8 tanggal_surat"></div>
             </div>
             <div class="row">
               <div class="col-3">Tanggal Terima</div>
               <div class="col-1">:</div>
               <div class="col-8 tanggal_terima"></div>
             </div>
             <div class="row">
               <div class="col-3">Ringkasan</div>
               <div class="col-1">:</div>
               <div class="col-8 ringkasan"></div>
             </div>
             <div class="row">
               <div class="col-3">Keterangan</div>
               <div class="col-1">:</div>
               <div class="col-8" id="id_klasifikasi_view"></div>
             </div>
             <div class="row">
               <div class="col-3">Status Surat</div>
               <div class="col-1">:</div>
               <div class="col-8" id="id_status_view"></div>
             </div>
           </div>
           <div class="col-lg-5">
            <div id="lampiran_view"></div>
            <a href="" id="download" target="_blank" class="btn btn-success text-white"><i class="fa fa-file"></i> Lihat Lampiran</a>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>