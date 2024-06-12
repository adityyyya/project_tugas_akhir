@extends('page.layout.index')

@section('content')
<div class="container-fluid" id="dashboard">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Surat Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$surat_masuk}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('data.surat', ['type' => 'masuk']) }}">
                                <i class="fas fa-envelope fa-2x" style="color: blue !important;"></i>
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Surat Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$surat_keluar}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('data.surat', ['type' => 'keluar']) }}">
                                <i class="fas fa-envelope fa-2x" style="color: rgb(38, 175, 0) !important;"></i>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Disposisi
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$disposisi}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a  href=" {{route('galery_surat','masuk')}} ">
                                <i class="fas fa-envelope fa-2x" style="color: rgb(0, 175, 149) !important;"></i>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        @if(Auth::user()->level == 'Admin')
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pengguna Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pengguna}}</div>
                        </div>
                        <div class="col-auto">
                            <a  href=" {{route('data_user')}} ">
                            <i class="fas fa-user fa-2x" style="color: rgb(255, 171, 3);"></i>
                            <a/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- End of Page Content -->


@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    @if(session('welcome'))
    Swal.fire({
        position: 'top',
        title: 'Selamat Datang',
        html: '<p>{{ Auth::user()->name }}</p>',
        icon: null, // Menghilangkan ikon
        showConfirmButton: true,
        confirmButtonText: 'OK',
        customClass: {
            title: 'swal2-title-custom'
        }
    });
    @endif
</script>
<style>
    .swal2-title-custom {
        margin-bottom: 0; /* Mengurangi jarak antara judul dan konten */
    }
</style>
@endsection
