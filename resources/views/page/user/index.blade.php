@extends('page.layout.index')

@section('content')
<div id="loading">
    <span class="fa fa-spinner fa-spin fa-3x"></span>
</div>
<div id="pageSurat">
    <div id="suratMasukContent" class="content-wrapper"  style="margin-top: 20px; margin-left: 20px; margin-right: 20px;">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div>
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Kelola /</span>
                        <span class="font-weight-bold">Data Pengguna</span>
                    </h4>
                    <div class="py-3">
                        <a href="javascript:void(0)" class="btn btn-primary new"><i class="fa fa-plus"></i> Tambah Pengguna</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_pengguna" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP</th>
                            <th>Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Status</th>
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
<div class="modal fade" data-bs-backdrop="static" id="modal_form" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1"></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="penggunaForm" method="post">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                    <label>Nama <span class="text-danger">*</span></label>
                    <input type="" hidden="" id="id" name="id">
                    <input type="text" required="" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" required="" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Password <span class="text-danger" id="required_password"></span></label>
                    <input type="text" class="form-control" id="password" name="password">
                    <input type="hidden" class="form-control" id="passwordLama" name="passwordLama">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>NIP</label>
                    <input type="number" class="form-control" id="nip" name="nip">
                </div>
            </div>            
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-control select2" required="" style="width: 100%;" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Foto <span class="text-danger" id="required_foto"></span></label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    <input type="hidden" class="form-control" id="fotoLama" name="fotoLama">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Jabatan <span class="text-danger">*</span></label>
                    <select class="form-control select2" required="" style="width: 100%;" id="level" name="level">
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Kasi Pem - Kemasy">Kasi Pem - Kemasy</option>
                        <option value="Kasi Ekobag">Kasi Ekobag</option>
                        <option value="Kasi Trantibum">Kasi Trantibum</option>
                        <option value="Lurah">Lurah</option>
                        <option value="Petugas">Petugas</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Status Pengguna <span class="text-danger">*</span></label>
                    <select class="form-control select2" required="" style="width: 100%;" id="status" name="status">
                        <option value="A">Aktif</option>
                        <option value="I">Non Aktif</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-loading" id="modal-loading" style="display: none;">
        <span class="fa fa-spinner fa-spin fa-3x"></span>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="">Tutup</span>
      </button>
      <button class="btn btn-primary ml-1">
        <i class="fa fa-save"></i>
        <span>Simpan</span>
    </button>
</div>
</form>
</div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  function show_loading() {
    var elemenModalLoading = document.getElementsByClassName('modal-loading');
    var ModalBody = document.getElementsByClassName('modal-body');
    for (var i = 0; i < elemenModalLoading.length; i++) {
      elemenModalLoading[i].style.display = "block";
  }
  for (var i = 0; i < ModalBody.length; i++) {
      ModalBody[i].style.pointerEvents = "none";
      ModalBody[i].style.background = 'white';
      ModalBody[i].style.opacity = '0.4';
  }
}
function hide_loading() {
    var elemenModalLoading = document.getElementsByClassName('modal-loading');
    var ModalBody = document.getElementsByClassName('modal-body');
    for (var i = 0; i < elemenModalLoading.length; i++) {
      elemenModalLoading[i].style.display = "none";
  }
  for (var i = 0; i < ModalBody.length; i++) {
      ModalBody[i].style.pointerEvents = "auto";
      ModalBody[i].style.background = "transparent";
      ModalBody[i].style.opacity = '1';
  }
}
$("#jenis_kelamin").select2({
    placeholder: ":. PILIH JENIS KELAMIN .:",
    dropdownParent: $("#modal_form")
});
$("#level").select2({
    placeholder: ":. PILIH JABATAN .:",
    dropdownParent: $("#modal_form")
});
$("#status").select2({
    placeholder: ":. PILIH STATUS .:",
    dropdownParent: $("#modal_form")
});
$(function () {
    $('#table_pengguna').DataTable({
        processing: true,
        pageLength: 10,
        responsive: true,
        ajax: {
            url: "{{ route('data_user') }}",
            error: function (jqXHR, textStatus, errorThrown) {
                $('#table_pengguna').DataTable().ajax.reload();
            }
        },
        columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { 
            data: 'name', 
            name: 'name', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { 
            data: 'email', 
            name: 'email', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { 
            data: 'nip', 
            name: 'nip', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { 
            data: 'telepon', 
            name: 'telepon', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { 
            data: 'jenis_kelamin', 
            name: 'jenis_kelamin', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { 
            data: 'level', 
            name: 'level', 
            render: function (data, type, row) {
                if (data == 'Sekretaris') {
                    return '<span class="badge bg-info text-white">'+data+'</span>';
                } else if (data == 'Kasi Pem - Kemasy') {
                    return '<span class="badge bg-warning text-white">'+data+'</span>';
                } else if (data == 'Kasi Ekobag') {
                    return '<span class="badge bg-success text-white">'+data+'</span>';
                } else if (data == 'Kasi Trantibum') {
                    return '<span class="badge bg-danger text-white">'+data+'</span>';
                } else if (data == 'Lurah') {
                    return '<span class="badge bg-primary text-white">'+data+'</span>';
                } else if (data == 'Petugas') {
                    return '<span class="badge bg-secondary text-white">'+data+'</span>';
                } else {
                    return '<span class="badge bg-dark text-white">'+data+'</span>';
                }
            }
        },
        { 
            data: 'status', 
            name: 'status', 
            render: function (data, type, row) {
                if (data == 'A') {
                    return '<span class="badge bg-success text-white">Aktif</span>';
                }else{
                    return '<span class="badge bg-danger text-white">Non Aktif</span>';
                }
            }  
        },
        { data: 'action', name: 'action', orderable: false, className: 'space' }
        ]
    });
});
var ajaxUrl;
$(".new").click(function() {
    $("#penggunaForm")[0].reset();
    $(".modal-title").html('<i class="fa fa-plus"></i> Form Tambah Pengguna');
    $("#modal_form").modal('show');
    $("#required_password").html('*');
    $("#password").attr('required',true);
    $(".select2").val(null).trigger('change');
    ajaxUrl = " {{route('save_user')}} ";
});
$(function () {
    $('#penggunaForm').submit(function(e) {
        e.preventDefault();
        show_loading();
        let formData = new FormData(this);
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
                hide_loading();
                if (response.status == 'true') {
                    $("#modal_form").modal('hide');
                    $("#penggunaForm")[0].reset();
                    Swal.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Success',
                        text: response.message
                    });
                    $('#table_pengguna').DataTable().ajax.reload();
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
                hide_loading();
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
function get_edit(userID) {
    $.ajax({
        type: "GET",
        url: "{{url('page/user_pengguna/get_edit')}}"+"/"+userID,
        success: function(response) {
            hide_loading();
            $.each(response, function(key, value) {
                $("#id").val(value.id);
                $("#name").val(value.name);
                $("#email").val(value.email);
                $("#passwordLama").val(value.password);
                $("#nip").val(value.nip);
                $("#jenis_kelamin").val(value.jenis_kelamin).trigger('change');
                $("#status").val(value.status).trigger('change');
                $("#level").val(value.level).trigger('change');
                $("#telepon").val(value.telepon);
                $("#fotoLama").val(value.foto);
            });
        },
        error: function(response) {
            get_edit(userID);
        }
    });
}
$(document).on('click','.edit',function() {
    var userID = $(this).attr('more_id');
    ajaxUrl = "{{route('update_user')}}";
    show_loading();
    $("#penggunaForm")[0].reset();
    $(".modal-title").html('<i class="fa fa-edit"></i> Form Ubah Pengguna');
    $("#required_password").html('');
    $("#password").attr('required',false);
    $("#modal_form").modal('show');
    if (userID) {
        get_edit(userID);
    }
});
$(document).on('click', '.delete', function (event) {
    userID = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
        title: 'Lanjut Hapus Data?',
        text: 'Data Pengguna akan dihapus secara Permanent!',
        icon: 'warning',
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: 'Lanjutkan'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "{{url('page/user_pengguna/destroy')}}"+"/"+userID,
                success: function(response) {
                    if (response.status == 'true') {
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        $('#table_pengguna').DataTable().ajax.reload();
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
