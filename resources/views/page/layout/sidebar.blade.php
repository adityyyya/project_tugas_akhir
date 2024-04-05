<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logobanjar.png') }}"  width="50" height="50" class="img-fluid">
        </div>
        <div class="sidebar-brand-text mx-3">E-ARSIP</div>
    </a>
    <hr class="sidebar-divider my-0">
    <?php
    $currentRoute = request()->route()->getName();
    $isDataMaster = false;

    if ($currentRoute == 'data_klasifikasi' || $currentRoute == 'data_status') {
        $isDataMaster = true;
    }
    ?>
    <li class="nav-item {{ (route('dashboard') == url()->current()) ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            MENU UTAMA
        </div>
        <li class="nav-item {{ request()->routeIs('data.surat*') ? ' active' : '' }}">
            <a class="nav-link {{ request()->routeIs('data.surat*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-envelope"></i>
                <span>Transaksi Surat</span>
            </a>
            <div id="collapseTwo" class="collapse {{ request()->routeIs('data.surat*') ? ' show' : '' }}" aria-labelledby="headingTwo"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Surat</h6>
                    <a class="collapse-item {{ (route('data.surat', 'masuk') == url()->current()) ? ' active' : '' }}" href="{{ route('data.surat', ['type' => 'masuk']) }}">Surat Masuk</a>
                    <a class="collapse-item {{ (route('data.surat', 'keluar') == url()->current()) ? ' active' : '' }}" href="{{ route('data.surat', ['type' => 'keluar']) }}">Surat Keluar</a>
                </div>
            </div>
        </li>
        <li class="nav-item {{ request()->routeIs('buku_agenda*') ? ' active' : '' }}">
            <a class="nav-link {{ request()->routeIs('buku_agenda*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseUtilities"aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-book"></i>
                <span>Buku Agenda</span>
            </a>
            <div id="collapseUtilities" class="collapse {{ request()->routeIs('buku_agenda*') ? ' show' : '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ (route('buku_agenda', 'masuk') == url()->current()) ? ' active' : '' }}" href=" {{ROUTE('buku_agenda','masuk')}} ">Surat Masuk</a>
                    <a class="collapse-item {{ (route('buku_agenda', 'keluar') == url()->current()) ? ' active' : '' }}" href=" {{ROUTE('buku_agenda','keluar')}} ">Surat Keluar</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            MENU LAINYA
        </div>
        <li class="nav-item {{ request()->routeIs('galery_surat*') ? ' active' : '' }}">
            <a class="nav-link {{ request()->routeIs('galery_surat*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-controls="collapsePages1">
                <i class="fas fa-fw fa-folder"></i>
                <span>Galeri Surat</span>
            </a>
            <div id="collapsePages1" class="collapse {{ request()->routeIs('galery_surat*') ? ' show' : '' }}" aria-labelledby="headingPages1" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Galeri</h6>
                    <a class="collapse-item {{ (route('galery_surat', 'masuk') == url()->current()) ? ' active' : '' }}" href="{{route('galery_surat','masuk')}}">Surat Masuk</a>
                    <a class="collapse-item {{ (route('galery_surat', 'keluar') == url()->current()) ? ' active' : '' }}" href="{{route('galery_surat','keluar')}}">Surat Keluar</a>
                </div>
            </div>
        </li>
        <li class="nav-item {{ $isDataMaster ? ' active' : '' }}">
            <a class="nav-link {{ $isDataMaster ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-controls="collapsePages2">
                <i class="fas fa-fw fa-file"></i>
                <span>Klasifikasi</span>
            </a>
            <div id="collapsePages2" class="collapse {{ $isDataMaster ? 'show' : '' }}" aria-labelledby="headingPages2" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ (route('data_klasifikasi') == url()->current()) ? ' active' : '' }}" href="{{route('data_klasifikasi')}}">Klasifikasi Surat</a>
                    <a class="collapse-item {{ (route('data_status') == url()->current()) ? ' active' : '' }}" href="{{route('data_status')}}">Status Surat</a>
                </div>
            </div>
        </li>
        @if(auth()->check() && auth()->user()->level === 'Admin')
        <li class="nav-item {{ (route('data_user') == url()->current()) ? ' active' : '' }}">
            <a class="nav-link collapsed" href=" {{route('data_user')}} ">
                <i class="fas fa-fw fa-user"></i>
                <span>Kelola Pengguna</span>
            </a>
        </li>
        @endif
        <hr class="sidebar-divider d-none d-md-block">
    </ul>
