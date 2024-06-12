<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
date_default_timezone_set('Asia/Ujung_Pandang');

class Surat extends Model
{
    // use HasFactory;
	protected $table="surat";
	protected $primaryKey="id_surat";

	public static function getAnggota()
	{
		$data = User::where('users.level','!=','Admin')
		->get();
		return $data;
	}
    public static function getDataSurat($request, $type)
    {
        $data = Surat::leftJoin('users as disposisi', 'disposisi.id', '=', 'surat.disposisi')
            ->leftJoin('klasifikasi_surat', 'klasifikasi_surat.id_klasifikasi', '=', 'surat.id_klasifikasi')
            ->leftJoin('status_surat', 'status_surat.id_status', '=', 'surat.id_status')
            ->where('surat.tipe_surat', $type);
    
        if (!empty($request->awal)) {
            $data->whereBetween('surat.tanggal_terima', [$request->awal, $request->akhir]);
        } else {
            $data->where('surat.tanggal_terima', date('Y-m-d'));
        }
    
        // Terapkan pengurutan berdasarkan waktu pembuatan, dimulai dari yang terbaru
        $data = $data->orderBy('surat.created_at', 'desc')->get();
      
        return $data;
    }
        

	public static function getEditSurat($id_surat)
{
    $data = Surat::leftJoin('users as disposisi', 'disposisi.id', '=', 'surat.disposisi')
        ->leftJoin('klasifikasi_surat', 'klasifikasi_surat.id_klasifikasi', '=', 'surat.id_klasifikasi')
        ->leftJoin('status_surat', 'status_surat.id_status', '=', 'surat.id_status')
        ->select('surat.*', 'klasifikasi_surat.nama_klasifikasi', 'status_surat.nama_status', 'users.name as disposisi_name')
        ->where('surat.id_surat', $id_surat)
        ->first(); // Menggunakan first() untuk mendapatkan satu data saja

    return $data;
}

public static function getGalerySurat($type)
{
    $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login
    $userLevel = auth()->user()->level; // Mendapatkan level pengguna yang sedang login

    // Jika pengguna memiliki level super admin (contoh: level 1), tidak perlu menerapkan filter berdasarkan ID pengguna
    $data = Surat::leftJoin('users as disposisi', 'disposisi.id', '=', 'surat.disposisi')
        ->leftJoin('klasifikasi_surat', 'klasifikasi_surat.id_klasifikasi', '=', 'surat.id_klasifikasi')
        ->leftJoin('status_surat', 'status_surat.id_status', '=', 'surat.id_status')
        ->select('surat.*', 'disposisi.name as disposisi_name') // Menambahkan seleksi nama disposisi
        ->where('surat.tipe_surat', $type);

    if ($type !== 'masuk') {
        // Jika tipe surat bukan masuk, maka semua level pengguna dapat melihat
        $data = $data->get();
    } else {
        // Jika tipe surat adalah masuk, terapkan filter berdasarkan ID pengguna yang sedang login
        if ($userLevel == 'Admin') {
            $data = $data->get();
        } else {
            $data = $data->where('surat.disposisi', $userId)->get();
        }
    }

    return $data;
}

		
	public static function getBukuAgendaSurat($request, $type)
	{
		$data = Surat::leftJoin('users as disposisi','disposisi.id','=','surat.disposisi')
		->leftJoin('klasifikasi_surat','klasifikasi_surat.id_klasifikasi','=','surat.id_klasifikasi')
		->leftJoin('status_surat','status_surat.id_status','=','surat.id_status')
		->where('surat.tipe_surat',$type);
		if (!empty($request->awal)) {
			$data->whereBetween('surat.tanggal_terima',[$request->awal,$request->akhir]);
		}
		// if (Auth::user()->level != 'Admin') {
		// 	$data->where('surat_detail.disposisi',Auth::user()->id);
		// }
		$data = $data->get();
		return $data;
	}
    public static function getNotifSurat()
    {
        $data = Surat::leftJoin('users as disposisi', 'disposisi.id', '=', 'surat.disposisi')
            ->leftJoin('klasifikasi_surat', 'klasifikasi_surat.id_klasifikasi', '=', 'surat.id_klasifikasi')
            ->leftJoin('status_surat', 'status_surat.id_status', '=', 'surat.id_status')
            ->select(
                \DB::RAW('surat.ringkasan as ringkasan'),
                \DB::RAW('surat.pengirim as pengirim'),
                \DB::RAW('surat.created_at as created_at')
            )
            ->where('surat.tipe_surat', 'Masuk')
            ->where('surat.disposisi', '!=', NULL)
            ->where('surat.disposisi', Auth::user()->id)
            ->where('surat.notifikasi', '!=', 'YA') // Hanya ambil notifikasi yang belum dilihat
            ->orderBy('surat.created_at', 'desc')
            ->get();
    
        return $data;
    }
    

    


}
