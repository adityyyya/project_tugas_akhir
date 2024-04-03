
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sistem Informasi E-Arsip Kelurahan Alalak Tengah</title>
    @include('home.head')
</head>
    <head>
    <!-- Untuk memuat Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    </head>

<body id="page-top">
    @if (session()->has('success'))
    <div class="alert alert-success notification show">
        {{ session('success') }}
    </div>
@endif
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       @include('home.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
              @include('home.navbar')
                <!-- End of Topbar -->
               @yield('content')
                    <!-- Other content -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function toggleIconDanGulirSuratMasuk() {
            var icon = document.querySelector('.nav-link .fas.fa-caret-down');
            icon.classList.toggle('fa-rotate-180');
            document.getElementById('suratMasukContent').scrollIntoView({ behavior: 'smooth' });
        }

        function toggleIconDanGulirSuratKeluar() {
            var icon = document.querySelector('.nav-link .fas.fa-caret-down');
            icon.classList.toggle('fa-rotate-180');
            document.getElementById('suratKeluarContent').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
   <script src="{{ asset('vendor/sb-admin-2/js/sb-admin-2.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Hide success message after 5 seconds
            setTimeout(function() {
                $(".alert-success").alert('close');
            }, 5000); // Adjust the time (in milliseconds) as needed
        });
    </script>
 <script>
    function selectOption(option) {
        document.getElementById('note').value = option;
    }
    </script>    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        
        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables
                $('#dataTable').DataTable({
                    "lengthMenu": [10, 25, 50, 100], // Pilihan jumlah data yang ditampilkan
                    "pageLength": 10, // Jumlah data yang ditampilkan per halaman secara default
                    "searching": true // Aktifkan fitur pencarian
                });
            });
        </script>  

</body>

</html>