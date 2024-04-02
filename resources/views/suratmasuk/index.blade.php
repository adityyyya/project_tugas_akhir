<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Masuk</title>
    @include('home.head')
</head>
<body>
  @include('home.index')

    <!-- Konten Surat Masuk -->
    <div id="suratMasukContent" class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div>
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Transaksi Surat /</span>
                        <span class="font-weight-bold">Surat Masuk</span>
                    </h4>
                    <div class="py-3">
                        <a href="{{ route('create') }}" class="btn btn-primary">Tambah Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
