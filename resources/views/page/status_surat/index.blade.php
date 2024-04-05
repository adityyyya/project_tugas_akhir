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
                        <span class="text-muted fw-light">Klasifikasi /</span>
                        <span class="font-weight-bold">Status Surat</span>
                    </h4>
                    <div class="py-3">
                        <a href="javascript:void(0)" class="btn btn-primary new"><i class="fa fa-plus"></i> Tambah Status</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Status Surat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table_status" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Status Surat</th>
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
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1"></h5>
    </div>
    <div class="modal-body">
        <form id="statusForm" method="post">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                    <label>Status Surat</label>
                    <input type="" id="id_status" name="id_status" hidden="">
                    <input type="text" required="" class="form-control" id="nama_status" name="nama_status">
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

$(function () {
    $('#table_status').DataTable({
        processing: true,
        pageLength: 10,
        responsive: true,
        ajax: {
            url: "{{ route('data_status') }}",
            error: function (jqXHR, textStatus, errorThrown) {
                $('#table_status').DataTable().ajax.reload();
            }
        },
        columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex'},
        { 
            data: 'nama_status', 
            name: 'nama_status', 
            render: function (data, type, row) {
                return data;
            }  
        },
        { data: 'action', name: 'action', orderable: false, className: 'space' }
        ]
    });
});
var ajaxUrl;
$(".new").click(function() {
    $("#statusForm")[0].reset();
    $(".modal-title").html('<i class="fa fa-plus"></i> Form Tambah Status');
    $("#modal_form").modal('show');
    ajaxUrl = " {{route('save_status')}} ";
});
$(function () {
    $('#statusForm').submit(function(e) {
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
                    $("#statusForm")[0].reset();
                    Swal.fire({
                        icon: 'success',
                        type: 'success',
                        title: 'Success',
                        text: response.message
                    });
                    $('#table_status').DataTable().ajax.reload();
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
function get_edit(statusUD) {
    $.ajax({
        type: "GET",
        url: "{{url('page/status_surat/get_edit')}}"+"/"+statusUD,
        success: function(response) {
            hide_loading();
            $.each(response, function(key, value) {
                $("#id_status").val(value.id_status);
                $("#nama_status").val(value.nama_status);
            });
        },
        error: function(response) {
            get_edit(statusUD);
        }
    });
}
$(document).on('click','.edit',function() {
    var statusUD = $(this).attr('more_id');
    ajaxUrl = "{{route('save_status')}}";
    show_loading();
    $("#statusForm")[0].reset();
    $(".modal-title").html('<i class="fa fa-edit"></i> Form Ubah Status');
    $("#modal_form").modal('show');
    if (statusUD) {
        get_edit(statusUD);
    }
});
$(document).on('click', '.delete', function (event) {
    statusUD = $(this).attr('more_id');
    event.preventDefault();
    Swal.fire({
        title: 'Lanjut Hapus Data?',
        text: 'Data Status Surat akan dihapus secara Permanent!',
        icon: 'warning',
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: 'Lanjutkan'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "{{url('page/status_surat/destroy')}}"+"/"+statusUD,
                success: function(response) {
                    if (response.status == 'true') {
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        });
                        $('#table_status').DataTable().ajax.reload();
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
