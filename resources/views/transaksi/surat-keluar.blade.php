<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keluar</title>
    @include('home.head')
</head>
<body>
  @include('home.index')

    <!-- Konten Surat Masuk -->
    <div id="suratKeluarContent" class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div>
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Transaksi Surat /</span>
                        Surat Keluar
                    </h4>
                    <div class="py-3">
                        <a href="http://127.0.0.1:8000/transaction/incoming/create" class="btn btn-primary">Tambah Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
