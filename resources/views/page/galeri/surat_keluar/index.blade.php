@extends('page.layout.index')

@section('content')
<div id="loading">
    <span class="fa fa-spinner fa-spin fa-3x"></span>
</div>
<div id="pageSurat">
    <div id="" class="content-wrapper" style="margin-top: 20px; margin-left: 20px; margin-right: 20px;">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div>
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Galery /</span>
                        <span class="font-weight-bold">Surat {{$tipe_surat}}</span>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Galery Surat</h6>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->reverse() as $dt)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dt->nomor_surat}}</td>
                            <td>{{$dt->pengirim}}</td>
                            <td>{{$dt->tanggal_surat}}</td>
                            <td>
                                <a href="javascript:void(0)" more_id="{{$dt->id_surat}}" class="btn view btn-secondary text-white rounded-pill btn-sm"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('page.surat_keluar.view') <!-- Include modal view untuk surat keluar -->

@endsection

@section('scripts')
<script type="text/javascript">
    function TanggalIndonesia(tanggal) {
        const months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        const days = [
            "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"
        ];

        const now = tanggal ? new Date(tanggal) : new Date();
        const day = days[now.getDay()];
        const date = now.getDate();
        const month = months[now.getMonth()];
        const year = now.getFullYear();

        return `${day}, ${date} ${month} ${year}`;
    }

    $(document).ready(function () {
        $('#table_galery').DataTable({
            "lengthMenu": [10, 25, 50, 100],
            "pageLength": 10,
            "searching": true
        });
    });

    function get_edit(suratID) {
    $.ajax({
        type: "GET",
        url: "{{ url('page/surat/get_edit') }}/" + suratID,
        success: function(response) {
            $(".modal-title").html(response.nomor_surat);
                $(".nomor_surat").html(response.nomor_surat);
                $("#id_klasifikasi_view").html(response.nama_klasifikasi);
                $("#id_status_view").html(response.nama_status);
                $(".pengirim").html(response.pengirim);
                $(".tanggal_surat").html(TanggalIndonesia(response.tanggal_surat));
                $(".tanggal_terima").html(TanggalIndonesia(response.tanggal_terima));
                $(".ringkasan").html(response.ringkasan);
                var path = "{{asset('lampiran')}}/"+response.lampiran_surat;
                $('#lampiran_view').html('<embed class="img img-fluid" src="{{asset('lampiran')}}/'+response.lampiran_surat+'"></embed>');
                $('#download').attr('href','{{asset('lampiran')}}/'+response.lampiran_surat);
        },
        error: function (response) {
            get_edit(suratID);
        }
    });
}

    $(document).on('click', '.view', function () {
        var suratID = $(this).attr('more_id');
        $("#modal_view").modal('show');
        if (suratID) {
            get_edit(suratID);
        }
    });
</script>
@endsection
