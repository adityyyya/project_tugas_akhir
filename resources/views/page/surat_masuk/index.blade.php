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
                        <span class="text-muted fw-light">Transaksi Surat /</span>
                        <span class="font-weight-bold">Surat {{$tipe_surat}}</span>
                    </h4>
                    <div class="py-3">
                        <a href="javascript:void(0)" class="btn btn-primary new"><i class="fa fa-plus"></i> Tambah Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 pb-4 mb-2" style="background: white;box-shadow:2px 2px grey;">
        <br>
        <span class="text">Tanggal Terima</span>
        <input type="date" required="" value="{{request()->has('awal') ? request()->input('awal') : ''}}" title="Tanggal Terima - Awal" class="form-control mt-2" name="awal" id="awal">
        <input type="date" required="" value="{{request()->has('akhir') ? request()->input('akhir') : ''}}" class="form-control mt-2" title="Tanggal Terima - Akhir" name="akhir" id="akhir">
        <button class="btn btn-sm btn-success mt-2" type="button" id="filter"><i class="fa fa-filter"></i> Tampilkan</button>
        <a href=" {{route('data.surat',$type)}} " class="btn btn-sm btn-info mt-2">Refresh</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_surat" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nomor Surat</th>
                            <th>Pengirim</th>
                            <th>Nomor Agenda</th>
                            <th>Tanggal Surat</th>
                            <th>Disposisi</th>
                            <th>Ringkasan</th> 
                            <th>Action</th>
                        </tr>                        
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
@include('page.surat_masuk.form')
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
  function SuratTable(awal=null,akhir=null) {
    $('#table_surat').DataTable({
        processing: true,
        pageLength: 10,
        responsive: true,
        ajax: {
            url: "{{ route('data.surat',$type) }}",
            data: {awal:awal, akhir:akhir},
            error: function (jqXHR, textStatus, errorThrown) {
                $('#table_surat').DataTable().ajax.reload();
            }
        },
        columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { 
            data: 'nomor_surat', 
            name: 'nomor_surat', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { 
            data: 'pengirim', 
            name: 'pengirim', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { 
            data: 'nomor_agenda', 
            name: 'nomor_agenda', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { 
            data: 'tanggal_surat', 
            name: 'tanggal_surat', 
            render: function (data, type, row) {
                return TanggalIndonesia(data);
            }  
        },
        { 
            data: 'name', 
            name: 'name', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { 
        data: 'ringkasan', 
        name: 'ringkasan', 
        render: function (data, type, row) {
            return data;}    
        },
        { data: 'action', name: 'action', orderable: false, className: 'space' }
        ]
    });
}
var awal, akhir;
$(function () {
    SuratTable(awal,akhir);
});
$(document).on('click', '#filter', function() {
    awal = $("#awal").val();
    akhir = $("#akhir").val();
    if (awal) {
        $('#table_surat').DataTable().destroy();
        SuratTable(awal, akhir);
    }else{
        alert('Masukkan Tanggal Pencarian');
    }
});
$("#pageSuratForm").hide();
var ajaxUrl;
$(".new").click(function() {
    ajaxUrl = "{{route('save.surat')}}";
    $("#suratForm")[0].reset();
    $("#pageSurat").hide();
    $("#loading").show();
    setTimeout(function() {
        $("#loading").hide();
        $("#pageSuratForm").show();
        $("#label_header").html('Tambah Baru');
        $("#required_lampiran").html('*');
        $("#lampiran").attr('required',true);
        $(".select2").val(null).trigger('change');
    }, 400);
});
$("#back").click(function() {
    $("#pageSuratForm").hide();
    $("#loading").show();
    setTimeout(function() {
        $("#loading").hide();
        $("#pageSurat").show();
    }, 400);
});
$("#disposisi").select2({
    placeholder: ":. PILIH NAMA .:"
});
$("#id_klasifikasi").select2({
    placeholder: ":. PILIH KLASIFIKASI .:"
});
$("#id_status").select2({
    placeholder: ":. PILIH STATUS .:"
});
$("#lampiran").on('change', function() {
    if (this.files && this.files[0]) {
        var file = this.files[0];
        var allowedExtensions = ['pdf'];
        var fileExtension = file.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            alert('File Dokumen tidak didukung.');
            $("#lampiran").val('');
            $("#lampiran").empty('');
            return;
        }
        $('.embed_scan').css('display','none');
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.embed_scan').css('display','block');
            $('.embed_scan').attr('src',e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
    } else {
        $('.embed_scan').css('display','none');
        $('#lampiran').val('');
        $('#lampiran').empty('');
    }
});
$(".modal_view_file_scan").removeClass('fade');
$(".lihat_berkas_scan_input").on('click',function() {
    $("#loading").show();
    setTimeout(function() {
        $("#loading").hide();
        $(".modal_view_file_scan").modal('show');
    }, 500);
});
$(function () {
    $('#suratForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $("#loading").show();
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            contentType: false,
            processData: false,
            url: ajaxUrl,
            data: formData,
            success: function (response) {
                $("#loading").hide();
                if (response.status == 'true') {
                    $("#pageSuratForm").hide();
                    $("#pageSurat").show();
                    $("#suratForm")[0].reset();
                    Swal.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Success',
                        text: response.message
                    });
                    $('#table_surat').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'Gagal',
                        dangerMode: true,
                        text: response.message
                    });
                }
            },
            error: function (response) {
                $("#loading").hide();
                Swal.fire({
                    icon: 'error',
                    type: 'error',
                    title: 'Gagal',
                    dangerMode: true,
                    text: response.message
                });
            }
        });
    });
});
function get_edit(suratID, action=null) {
    $.ajax({
        type: "GET",
        url: "{{url('page/surat/get_edit')}}"+"/"+suratID,
        success: function(response) {
            if (action == null) {
                $("#loading").hide();
                $("#pageSuratForm").show();
                $("#label_header").html('Edit Surat');
                $("#required_lampiran").html('');
                $("#lampiran").attr('required',false);
                $.each(response, function(key, value) {
                    $("#id_surat").val(value.id_surat);
                    $("#nomor_surat").val(value.nomor_surat);
                    $("#id_klasifikasi").val(value.id_klasifikasi).trigger('change');
                    $("#id_status").val(value.id_status).trigger('change');
                    $("#pengirim").val(value.pengirim);
                    $("#nomor_agenda").val(value.nomor_agenda);
                    $("#tanggal_surat").val(value.tanggal_surat);
                    $("#tanggal_terima").val(value.tanggal_terima);
                    $("#ringkasan").val(value.ringkasan);
                    $("#disposisi").val(value.disposisi).trigger('change');
                    $("#lampiranLama").val(value.lampiran_surat);
                    $('.embed_scan').css('display','block');
                    var path = "{{asset('lampiran')}}/"+value.lampiran_surat;
                    $('.embed_scan').attr('src',path);
                });
            }else{
                $.each(response, function(key, value) {
                    $(".modal-title").html(value.nomor_surat);
                    $(".nomor_surat").html(value.nomor_surat);
                    $("#id_klasifikasi_view").html(value.nama_klasifikasi);
                    $("#id_status_view").html(value.nama_status);
                    $(".pengirim").html(value.pengirim);
                    $(".nomor_agenda").html(value.nomor_agenda);
                    $(".tanggal_surat").html(TanggalIndonesia(value.tanggal_surat));
                    $(".tanggal_terima").html(TanggalIndonesia(value.tanggal_terima));
                    $(".ringkasan").html(value.ringkasan);
                    $("#disposisi_view").html(value.name);
                    var path = "{{asset('lampiran')}}/"+value.lampiran_surat;
                    $('#lampiran_view').html('<embed class="img img-fluid" src="{{asset('lampiran')}}/'+value.lampiran_surat+'"></embed>');
                    $('#download').attr('href','{{asset('lampiran')}}/'+value.lampiran_surat);
                });
            }
        },
        error: function(response) {
            get_edit(suratID, action);
        }
    });
}
$(document).on('click','.edit',function() {
    var suratID = $(this).attr('more_id');
    ajaxUrl = "{{route('update.surat')}}";
    $("#suratForm")[0].reset();
    $("#pageSurat").hide();
    $("#loading").show();
    if (suratID) {
        get_edit(suratID, null);
    }
});
$(document).on('click','.view',function() {
    var suratID = $(this).attr('more_id');
    $("#modal_view").modal('show');
    if (suratID) {
        get_edit(suratID, 'view');
    }
});
$(document).on('click', '.delete', function (event) {
    suratID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
        title: 'Lanjut Hapus Data?',
        text: 'Data Surat akan dihapus secara Permanent!',
        icon: 'warning',
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: 'Lanjutkan'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "{{url('page/surat/destroy')}}"+"/"+suratID,
                success: function(response) {
                    if (response.status == 'true') {
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        $('#table_surat').DataTable().ajax.reload();
                    }else{
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Terjadi kesalahan',
                            text: response.message
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'Gagal',
                        dangerMode: true,
                        text: 'Terjadi kesalahan!'
                    });
                }
            });
        }
    });
});
</script>
@endsection
