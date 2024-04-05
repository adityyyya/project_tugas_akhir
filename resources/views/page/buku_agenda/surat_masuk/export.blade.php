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
    margin: 100px 25px;
  }

  header {
    position: fixed;
    top: -100px;
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
 <header>
  <img src="{{asset('images/logobanjar.png')}}" width="85" height="85" style="float: left;margin-top: 10px;">Sistem Informasi E-Arsip <br>Kelurahan Alalak Tengah<br>
  <small>Laporan Surat Masuk | Periode Tanggal Surat : {{ request()->has('awal') ? request()->input('awal') : '-' }} - {{ request()->has('akhir') ? request()->input('akhir') : '-' }}</small>
</center>
</header>
<main>
 <div class="card-body">
  <br>
  <table style="width: 100%;padding: 0;margin: 0;" cellpadding="6" cellspacing="0" border="1">
   <thead>
    <tr style="background: #eee;">
     <th>No. </th>
     <th>Nomor Surat</th>
     <th>Pengirim</th>
     <th>Nomor Agenda</th>
     <th>Tanggal Surat</th>
     <th>Tanggal Terima</th>
     <th>Keterangan</th>
     <th>Ringkasan</th>
     <th>Disposisi</th>
   </tr>
 </thead>
 <tbody>
  @foreach($data as $dt)
  <tr>
    <td>{{$loop->index+1}}</td>
    <td>{{$dt->nomor_surat}}</td>
    <td>{{$dt->pengirim}}</td>
    <td>{{$dt->nomor_agenda}}</td>
    <td>{{$dt->tanggal_surat}}</td>
    <td>{{$dt->tanggal_terima}}</td>
    <td>{{$dt->nama_klasifikasi}}</td>
    <td>{{$dt->ringkasan}}</td>
    <td>{{$dt->name}}</td>
  </tr>
  @endforeach
</tbody>
</table>
</div>
</main>
</body>
</html>
