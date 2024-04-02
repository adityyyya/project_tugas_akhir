<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logobanjar.png') }}"  width="50" height="50" class="img-fluid">
        </div>
        <div class="sidebar-brand-text mx-3">E-ARSIP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}"">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span style="font-size: 17px;">Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MENU UTAMA
    </div>

    <!-- Nav Item - Transaksi Surat Collapse Menu -->
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo" onclick="toggleIconDanGulir()">
            <i class="fas fa-fw fa-envelope"></i>
            <span style="font-size: 17px;">Transaksi Surat</span>
        </a>
        <div id="collapseTwo" class="collapse @if(Request::is('surat-masuk') || Request::is('surat-keluar')) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('surat.masuk', ['nama_pengguna' => $nama_pengguna]) }} "onclick="toggleIconDanGulirSuratMasuk()">
                    Surat Masuk
                </a>
                <a class="collapse-item" href="{{ route('surat.keluar', ['nama_pengguna' => $nama_pengguna]) }} "onclick="toggleIconDanGulirSuratKeluar()">
                    Surat Keluar
                </a>
            </div>
        </div>
    </li>    
    <!-- Nav Item - Buku Agenda Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-book"></i>
            <span style="font-size: 17px;">Buku Agenda</span>
     </a>
     <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
           data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="utilities-color.html">Surat Masuk</a>
             <a class="collapse-item" href="utilities-border.html">Surat Keluar</a>
         </div>
      </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MENU LAINYA
    </div>

   <!-- Nav Item - Galeri Surat Collapse Menu -->
   <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-controls="collapsePages1">
        <i class="fas fa-fw fa-folder"></i>
        <span style="font-size: 17px;">Galeri Surat</span>
    </a>
    <div id="collapsePages1" class="collapse" aria-labelledby="headingPages1" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="login.html">Surat Masuk</a>
            <a class="collapse-item" href="register.html">Surat Keluar</a>
        </div>
    </div>
</li>

<!-- Nav Item - Klasifikasi Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-controls="collapsePages2">
        <i class="fas fa-fw fa-file"></i>
        <span style="font-size: 17px;">Klasifikasi</span>
    </a>
    <div id="collapsePages2" class="collapse" aria-labelledby="headingPages2" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="login.html">Klasifikasi Surat</a>
            <a class="collapse-item" href="register.html">Status Surat</a>
        </div>
    </div>
</li>
@if(auth()->check() && auth()->user()->role === 'admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
            <i class="fas fa-fw fa-user"></i>
            <span style="font-size: 17px;">Kelola Pengguna</span>
        </a>
    </li>
@endif

    <hr class="sidebar-divider d-none d-md-block">
    


</ul>
