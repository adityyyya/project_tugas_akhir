@extends('home.index')

@section('content')
<div style="margin-top: 20px; margin-left: 20px; margin-right: 20px;">
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Transaksi Surat /</span>
    Surat Masuk / <span class="font-weight-bold">Tambah Baru</span>
</h4>
<div class="card mb-4">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="dyJUh282SFDHh5XgCGlnwOS0fG8KrxbBuMWAFk0A">           
         <div class="card-body row">
            <input type="hidden" name="type" value="incoming">
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
<label for="reference_number" class="form-label">Nomor Surat</label>
<input type="text" class="form-control " id="reference_number" name="reference_number" value="" />
<span class="error invalid-feedback"></span>
</div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
<label for="from" class="form-label">Pengirim</label>
<input type="text" class="form-control " id="from" name="from" value="" />
<span class="error invalid-feedback"></span>
</div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
<label for="agenda_number" class="form-label">Nomor Agenda</label>
<input type="text" class="form-control " id="agenda_number" name="agenda_number" value="" />
<span class="error invalid-feedback"></span>
</div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                <div class="mb-3">
<label for="letter_date" class="form-label">Tanggal Surat</label>
<input type="date" class="form-control " id="letter_date" name="letter_date" value="" />
<span class="error invalid-feedback"></span>
</div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                <div class="mb-3">
<label for="received_date" class="form-label">Tanggal Diterima</label>
<input type="date" class="form-control " id="received_date" name="received_date" value="" />
<span class="error invalid-feedback"></span>
</div>
            </div>
            <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                <div class="mb-3">
<label for="description" class="form-label">Ringkasan</label>
<textarea class="form-control " id="description" name="description" rows="3"></textarea>
<span class="error invalid-feedback"></span>
</div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div>
                    <label for="note" class="form-label">Disposisi</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="note" name="note" value="" placeholder="Nama...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilihan
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="selectOption('Kepala Lurah')">Kepala Lurah</a></li>
                                <li><a class="dropdown-item" href="#" onclick="selectOption('Sekertaris')">Sekretaris</a></li>
                                <li><a class="dropdown-item" href="#" onclick="selectOption('Bendahara')">Bendahara</a></li>
                            </ul>
                        </div>
                    </div>
                    <span class="error invalid-feedback"></span>
                </div>
                
            </div>           
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
<label for="note" class="form-label">Keterangan</label>
<input type="text" class="form-control " id="note" name="note" value="" />
<span class="error invalid-feedback"></span>
</div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="attachments" class="form-label">Lampiran</label>
                    <input type="file" class="form-control " id="attachments"
                           name="attachments[]" multiple/>
                    <span class="error invalid-feedback"></span>
                </div>
            </div>
            <div class="card-footer pt-3">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </form>
</div>
            </div>
        </div>

@endsection