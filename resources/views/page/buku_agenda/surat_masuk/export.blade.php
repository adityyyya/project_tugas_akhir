<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Surat Masuk</title>
  @if($_GET['keyword']=="Excel")
  <?php  
  header("Content-type: application/vnd-ms-excel");
  header('Content-Disposition: attachment; filename=Surat Masuk.xls'); 
  ?>
  @endif
  <!-- <link rel="stylesheet" href="{{asset('print.css')}}"> -->
</head>
<style type="text/css">
  @page {
    size: A4;
    margin: 2.10cm
  }

  header {
    position: fixed;
    top: -20px;
    left: 0px;
    right: 0px;
    height: 50px;
    font-size: 20px !important;

    /** Extra personal styles **/
    /*background-color: #008B8B;*/
    /*color: white;*/
    text-align: center;
    line-height: 35px;
  }

  footer {
    position: fixed; 
    bottom: -30px; 
    left: 0px; 
    right: 0px;
    height: 50px; 
    font-size: 20px !important;

    /** Extra personal styles **/
    /*background-color: #008B8B;*/
    /*color: white;*/
    text-align: center;
    line-height: 35px;
  }
</style>
<body>
 <header style="text-align: center;">
  <img src="{{asset('img/logobanjar.png')}}" width="100" height="100" style="position: absolute; top: 20px; left: 10px;">
  <div style="text-align: top; margin-left: 2px;">
    <span style="margin-top: 20px;">PEMERINTAH KOTA BANJARMASIN</span><br>
    <span>KECAMATAN BANJARMASIN UTARA</span><br>
    <span>KELURAHAN ALALAK TENGAH</span>
</div>

  <small style="text-align: center; display: block; font-size: 15px">Laporan Surat Masuk | Periode Tanggal Surat : 
    {{ request()->has('awal') ? request()->input('awal') : date('Y-m-d') }} 
    {{ request()->has('akhir') ? request()->input('akhir') : date('Y-m-d') }} ({{ date('d F Y') }})
</small>
<hr style="border: 1px solid black;">
</center>
</header>
<main>
 <div class="card-body" style="margin-top: 100;">
  <br>
  <table style="width: 100%;padding: 0;margin: 0;" cellpadding="6" cellspacing="0" border="1">
   <thead>
    <tr style="background: #eee;">
     <th style="font-size: 12px;">No. </th>
     <th style="font-size: 12px;">Nomor Surat</th>
     <th style="font-size: 12px;">Pengirim</th>
     <th style="font-size: 12px; width:100px;">Tanggal Surat</th>
     <th style="font-size: 12px; width:100px;">Tanggal Terima</th>
     <th style="font-size: 12px;">Klasifikasi</th>
     <th style="font-size: 12px;">Disposisi</th>
     <th style="font-size: 12px;">Keterangan</th>
   </tr>
 </thead>
 <tbody>
  @foreach($data as $dt)
  <tr>
    <td style="font-size: 12px; text-align: center;">{{$loop->index+1}}</td>
    <td style="font-size: 12px;">{{$dt->nomor_surat}}</td>
    <td style="font-size: 12px;">{{$dt->pengirim}}</td>
    <td style="font-size: 12px;  text-align: center;">{{$dt->tanggal_surat}}</td>
    <td style="font-size: 12px;  text-align: center;">{{$dt->tanggal_terima}}</td>
    <td style="font-size: 12px; text-align: center;">{{$dt->nama_klasifikasi}}</td>
    <td style="font-size: 12px; text-align: center;">{{$dt->name}}</td>
    <td style="font-size: 12px;">{{$dt->ringkasan}}</td>
</tr>
  @endforeach
</tbody>
</table>
</div>
</main>
</body>
</html>
