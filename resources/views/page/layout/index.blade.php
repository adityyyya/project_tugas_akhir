<!DOCTYPE html>
<html lang="en">
<?php  
$profil = App\Models\User::getUserProfil();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistem Informasi E-Arsip Kelurahan Alalak Tengah</title>
    <link rel="icon" type="image/png" href="{{asset('images/logobanjar.png')}}">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css" rel="stylesheet') }}" type="text/css">
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('foto.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <!-- Untuk memuat Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<style type="text/css">
    .modal-loading {
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      top: 50%;
      left: 50%;
      z-index: 9999;
      visibility: hidden;
  }
  .modal-body {
      position: relative;
  }
  .modal.show .modal-loading {
      visibility: visible;
  }
  #loading {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    text-align: center;
    padding-top: 20%;
}
.select2-hidden-accessible + .select2-container .select2-selection {
    height: 36px;
    padding-top: 2px;
}
.select2-hidden-accessible + .select2-container .select2-selection__arrow, .select2-hidden-accessible + .select2-container .select2-selection_clear{
    height: 40px;
}
select[readonly].select2-hidden-accessible + .select2-container {
    pointer-events: none;
    touch-action: none;
}
select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
    background: #e8ebed;
    box-shadow: none;
}

select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection_clear {
    display: none;
}
.is-invalid:valid + .select2 .select2-selection{
    border-color: #dc3545!important;
}
*:focus{
    outline:0px;
}
</style>
<body id="page-top">
    @if (session()->has('success'))
    <div class="alert alert-success notification show">
        {{ session('success') }}
    </div>
    @endif
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('page.layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('page.layout.navbar')
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
   <!--  <script>
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
    </script> -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
</body>
@yield('scripts')
@if(Auth::user()->level != 'Admin')
<script type="text/javascript">
    function waktuYangLalu(dateTimeString) {
        var dateTime = new Date(dateTimeString);
        var now = new Date();

        var difference = now - dateTime;
        var seconds = Math.floor(difference / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);

        if (days > 0) {
            return days + " hari yang lalu";
        } else if (hours > 0) {
            return hours + " jam yang lalu";
        } else if (minutes > 0) {
            return minutes + " menit yang lalu";
        } else {
            return "Baru saja";
        }
    }
    function read() {
    $.ajax({
        type: "GET",
        url: "{{route('get_notif_surat')}}",
        success: function(response) {
            var html = "";
            var countNotif = 0; // Menghitung jumlah notifikasi yang belum dilihat
            for (let x = 0; response.length > x; x++) {
                if (response[x].notifikasi !== 'YA') {
                    countNotif++;
                    if (countNotif <= 99) {
                        html += "<a class='dropdown-item d-flex align-items-center' href='#'><div class='dropdown-list-image mr-3'><img class='rounded-circle' src='{{ asset('img/undraw_profile_1.svg') }}' alt='...''><div class='status-indicator bg-success'></div></div><div class='font-weight-bold'><div class='text-truncate'>";
                        html += 'Pengirim: ' + response[x].pengirim;
                        html += "</div><div class='small text-gray-500'>" + response[x].ringkasan + " · " + waktuYangLalu(response[x].created_at) + "</div></div></a>";
                    }
                }
            }
            $("#count_notif_message").text(countNotif > 99 ? '99+' : countNotif);
            $("#content_notif_message").html(html);
        },
        error: function(response) {
            read();
        }
    });
}

// Update notifikasi menjadi 'YA' ketika tombol view diklik
$(document).on('click', '.view', function() {
    var suratID = $(this).attr('more_id');
    $.ajax({
        type: "GET",
        url: "{{ url('page/surat/get_edit') }}/" + suratID,
        success: function(response) {
            // Ubah tampilan modal seperti yang Anda butuhkan
            // ...

            // Ubah status notifikasi menjadi 'YA' hanya jika pengguna adalah penerima disposisi
            if (response.disposisi == '{{ Auth::user()->id }}') {
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
      setInterval(function(){
        read()
    }, 2000);   
  })
</script>
@endif
</html>