@extends('page.layout.index')

@section('content')
<div id="loading">
    <span class="fa fa-spinner fa-spin fa-3x"></span>
</div>
<!-- Modal untuk edit disposisi -->
<div class="modal fade myModal" id="modal_edit_disposisi" tabindex="-1" aria-labelledby="modal_edit_disposisi" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modal_edit_disposisi_title">Edit Disposisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit disposisi -->
                <form id="form_edit_disposisi" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="disposisi">Disposisi</label>
                        <select class="form-control select2" id="disposisi" name="disposisi">
                            @foreach($anggota as $agt)
                                <option value="{{$agt->id}}">{{$agt->level}}</option>
                            @endforeach
                        </select>
                    </div>           
                             
                    <!-- Hidden input untuk menyimpan id surat -->
                    <input type="hidden" id="suratID" name="suratID">
                    <!-- Tombol untuk menyimpan perubahan disposisi -->
                    <button type="submit" class="btn btn-primary" id="btn_submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="pageSurat">
    <div id="" class="content-wrapper"  style="margin-top: 20px; margin-left: 20px; margin-right: 20px;">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div>
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Gallery /</span>
                        <span class="font-weight-bold">Surat {{$tipe_surat === 'masuk' ? 'Masuk' : ''}}</span>
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
                            <th>Disposisi</th>
                            <th>Keterangan</th>
                            <th>Tanggal Surat</th>
                            <th>Tanggal Terima</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->reverse() as $dt)
                        <tr data-id_surat="{{$dt->id_surat}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dt->nomor_surat}}</td>
                            <td>{{$dt->pengirim}}</td>
                            <td class="disposisi_name">{{$dt->disposisi_name}}</td>
                            <td>{{$dt->ringkasan}}</td>
                            <td>{{$dt->tanggal_surat}}</td>
                            <td>{{$dt->tanggal_terima}}</td>
                            <td>
                                <a href="javascript:void(0)" more_id="{{$dt->id_surat}}" class="btn view btn-secondary text-white rounded-pill btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="javascript:void(0)" more_id="{{$dt->id_surat}}" data-disposisi="{{$dt->disposisi}}" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a>      
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                        
                </table>
            </div> 
        </div>
    </div>
</div>
@include('page.surat_masuk.view')
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
  $(document).ready(function() {
    $('#table_galery').DataTable({
        "lengthMenu": [10, 25, 50, 100],
        "pageLength": 10,
        "searching": true
    });
});
$(document).on('click', '.view', function() {
    var suratID = $(this).attr('more_id');
    $.ajax({
        type: "GET",
        url: "{{ url('page/surat/get_edit') }}/" + suratID,
        success: function(response) {
            $("#modal_view .modal-title-view").html(response.nomor_surat);
            $("#modal_view .nomor_surat").html(response.nomor_surat);
            $("#modal_view #id_klasifikasi_view").html(response.nama_klasifikasi);
            $("#modal_view #id_status_view").html(response.nama_status);
            $("#modal_view .pengirim").html(response.pengirim);
            $("#modal_view .tanggal_surat").html(TanggalIndonesia(response.tanggal_surat));
            $("#modal_view .tanggal_terima").html(TanggalIndonesia(response.tanggal_terima));
            $("#modal_view .ringkasan").html(response.ringkasan);
            $("#modal_view #disposisi_view").html(response.disposisi_name ? response.disposisi_name : '-');
            var path = "{{ asset('lampiran') }}/" + response.lampiran_surat;
            $('#modal_view #lampiran_view').html('<embed class="img img-fluid" src="' + path + '"></embed>');
            $('#modal_view #download').attr('href', path);

            // Munculkan modal
            $("#modal_view").modal("show");

            // Mengurangi angka notifikasi
            var countNotif = parseInt($("#count_notif_message").text());
            if (countNotif > 0) {
                countNotif--;
                $("#count_notif_message").text(countNotif > 3 ? '3+' : countNotif);

                // Mengirim permintaan ke server untuk mengubah status notifikasi
                $.ajax({
                    type: "GET",
                    url: "{{ route('update_notif_surat', ':id') }}".replace(':id', suratID),
                    success: function(response) {
                        console.log("Notifikasi diupdate");
                    },
                    error: function(response) {
                        console.log("Error updating notification:", response);
                    }
                });
            }
        },
        error: function(response) {
            console.log("Error:", response);
        }
    });
});


$(document).ready(function() {
        $('.myModal').on('shown.bs.modal', function () {
            $(".select2").select2({
                placeholder: ":. PILIH NAMA .:",
                width: '100%' // Set lebar Select2 ke 100%
            });
        });
    });

    $(document).on('click', '.view', function() {
    var suratID = $(this).attr('more_id');
    $.ajax({
        type: "GET",
        url: "{{ url('page/surat/get_edit') }}/" + suratID,
        success: function(response) {
            // Mengurangi angka notifikasi hanya jika belum diubah menjadi "YA"
            if (response.notifikasi !== 'YA') {
                var countNotif = parseInt($("#count_notif_message").text());
                countNotif = Math.max(0, countNotif - 1);
                $("#count_notif_message").text(countNotif > 3 ? '3+' : countNotif);
                // Mengirim permintaan ke server untuk mengubah status notifikasi
                $.ajax({
                    type: "GET",
                    url: "{{ route('update_notif_surat', ':id') }}".replace(':id', suratID),
                    success: function(response) {
                        console.log("Notifikasi diupdate");
                    },
                    error: function(response) {
                        console.log("Error updating notification:", response);
                        // Jika terjadi error, kembalikan angka notifikasi ke nilai sebelumnya
                        $("#count_notif_message").text(countNotif > 3 ? '3+' : countNotif + 1);
                    }
                });
            }
        },
        error: function(response) {
            console.log("Error:", response);
        }
    });
});



$(document).on('click', '.edit', function() {
    var disposisi = $(this).data('disposisi');
    var suratID = $(this).attr('more_id');
    $('#disposisi').val(disposisi);
    $('#suratID').val(suratID); // Menambahkan id surat ke hidden input
    $('#modal_edit_disposisi').modal('show');
});


$(document).on('submit', '#form_edit_disposisi', function(e) {
    e.preventDefault();
    var disposisi = $('#disposisi').val();
    var suratID = $('#suratID').val();

    $.ajax({
        type: "POST",
        url: "{{ url('page/surat/edit_disposisi') }}/" + suratID,
        data: {
            _token: '{{ csrf_token() }}',
            disposisi: disposisi
        },
        success: function(response) {
            $('#modal_edit_disposisi').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                });
            var table = $('#table_galery').DataTable();
            window.location.replace("surat_masuk");
        },
        error: function(response) {
            console.log("Error:", response);
            // Tambahkan logika untuk memberi umpan balik kepada pengguna jika diperlukan
        }
    });
});

$(document).ready(function() {
    $(document).on('click', '.close', function() {
        $('#modal_edit_disposisi').modal('hide');
    });
});

</script>

@endsection
