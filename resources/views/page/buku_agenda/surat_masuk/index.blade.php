@extends('page.layout.index')

@section('content')
<div id="loading">
    <span class="fa fa-spinner fa-spin fa-3x"></span>
</div>
<div id="pageSurat">
    <div id="" class="content-wrapper"  style="margin-top: 20px; margin-left: 20px; margin-right: 20px;">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div>
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Buku Agenda /</span>
                        <span class="font-weight-bold">Surat {{$tipe_surat}}</span>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 pb-4 mb-2" style="background: white;box-shadow:2px 2px grey;">
        <form method="get" action="">
            @csrf
            <br>
            <span class="text">Tanggal Terima</span>
            <input type="date" required="" value="{{ request()->has('awal') ? request()->input('awal') : '' }}" title="Tanggal Terima - Awal" class="form-control mt-2" name="awal">
            <input type="date" required="" value="{{ request()->has('akhir') ? request()->input('akhir') : '' }}" class="form-control mt-2" title="Tanggal Terima - Akhir" name="akhir">
            <button class="btn btn-sm btn-success mt-2"><i class="fa fa-filter"></i> Tampilkan</button>
            <a href="{{ route('buku_agenda', $type) }}" class="btn btn-sm btn-info mt-2">Reset</a>
            <a href="{{ route('export_buku_agenda', ['type' => $type, 'awal' => request()->has('awal') ? request()->input('awal') : '', 'akhir' => request()->has('akhir') ? request()->input('akhir') : '', 'keyword' => 'PDF']) }}" style="float: right;" target="_blank" class="btn btn-sm btn-danger mt-2"><i class="fa fa-file-pdf"></i></a>
        </form>        
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buku Agenda Surat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_galery" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nomor Surat</th>
                            <th>Pengirim</th>
                            <th>Tanggal Surat</th>
                            <th>Tanggal Terima</th>
                            <th>Keterangan</th>
                            <th>Disposisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dt)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$dt->nomor_surat}}</td>
                            <td>{{$dt->pengirim}}</td>
                            <td>{{$dt->tanggal_surat}}</td>
                            <td>{{$dt->tanggal_terima}}</td>
                            <td>{{$dt->nama_klasifikasi}}</td>
                            <td>{{$dt->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_galery').DataTable({
            "lengthMenu": [10, 25, 50, 100],
            "pageLength": 10,
            "searching": true
        });
    });
</script>
@endsection