@extends('page/layout/index')

@section('title', 'My Profil')

@section('content')
<div id="loading">
    <span class="fa fa-spinner fa-spin fa-3x"></span>
</div>
<div id="suratMasukContent" class="content-wrapper" style="margin-top: 20px; margin-left: 20px; margin-right: 20px;">
    <div class="row">
        <div class="col-lg-3 text-center">
            <h2>{{ Auth::user()->name }}</h2>
            <div class="profile_img">
                <div id="crop-avatar">
                    @if ($dt->foto == NULL)
                    <img class="img-responsive avatar-view rounded-pill" height="200" width="200" src="{{ asset('img/undraw_profile.svg') }}" alt="Avatar" title="Profile Foto">
                    @else
                    <img class="img-responsive avatar-view rounded-pill" height="200" width="200" src="{{ asset('foto') }}/{{ $dt->foto }}" alt="Avatar" title="Profile Foto">
                    @endif
                </div>
            </div>
            <h3>{{ $dt->name }}</h3>

            <ul class="list-unstyled user_data">
                <li><i class="fa fa-user user-profile-icon"></i> {{ $dt->nip }}</li>
                <li><i class="fa fa-briefcase user-profile-icon"></i> {{ Auth::user()->level }}</li>
                <li class="m-top-xs"><i class="fa fa-phone"></i> {{ $dt->telepon }}</li>
            </ul>
        </div>
        <div class="col-lg-9">
            <form id="profilForm" method="POST" enctype="multipart/form-data" action="{{ route('update_my_profil') }}">
                @csrf
                <div role="tabpanel" data-example-id="togglable-tabs">
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab_content1" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" required value="{{ $dt->name }}" autocomplete="off" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" required value="{{ $dt->email }}" autocomplete="off" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>NIP</label>
                                        <input type="text" value="{{ $dt->nip }}" autocomplete="off" class="form-control" id="nip" name="nip">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="number" value="{{ $dt->telepon }}" autocomplete="off" class="form-control" id="telepon" name="telepon">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-control" required style="width: 100%;" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="Laki-Laki" {{ $dt->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ $dt->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger" id="password_label"></span></label>
                                        <input type="password" autocomplete="off" class="form-control" name="password" id="password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="hidden" value="{{ $dt->foto }}" id="fotoLama" name="fotoLama">
                                        <div class="file-upload" style="width:100%;">
                                            <div class="image-upload-wrap">
                                                <input class="file-upload-input" name="foto" type='file' onchange="readURL(this);" accept="image/*" />
                                                <div class="drag-text">
                                                    <h3>Upload Foto <sup><br>(opsional)</sup></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()" class="remove-image">Hapus <span class="image-title">Uploaded Image</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Simpan</button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.image-upload-wrap').hide();
                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();
                $('.image-title').html(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload();
        }
    }
    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }
    $('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
    });
    $(function () {
        $('#profilForm').submit(function(e) {
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
                url: "{{ route('update_my_profil') }}",
                data: formData,
                success: function (response) {
                    $("#loading").hide();
                    if (response.status == 'true') {
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = "";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan! [data tidak tersimpan]'
                        });
                    }
                },
                error: function (response) {
                    $("#loading").hide();
                    Swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan! [data tidak tersimpan]'
                    });
                }
            });
        });
    });
</script>
@endsection
