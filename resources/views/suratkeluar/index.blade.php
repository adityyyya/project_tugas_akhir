@extends('home.index')

@section('content')
<body>
    <!-- Konten Surat Masuk -->
    <div id="suratKeluarContent" class="content-wrapper"  style="margin-top: 20px; margin-left: 20px; margin-right: 20px;">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div>
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Transaksi Surat /</span>
                        <span class="font-weight-bold">Surat Keluar</span>
                    </h4>
                    <div class="py-3">
                        <a href="{{ route('create') }}" class="btn btn-primary">Tambah Baru</a>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Pengirim</th>
                            <th>Nomer Agenda</th>
                            <th>Tanggal Surat</th>
                            <th>Disposisi</th>
                        </tr>
                    </thead>
</div> 


</body>
@endsection

