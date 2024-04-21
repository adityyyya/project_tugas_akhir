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
		$data = User::join('biodata','biodata.id_user','=','users.id')
		->where('users.level','!=','Admin')
		->get();
		return $data;
	}
	public static function getDataSurat($request, $type)
	{
		$data = Surat::join('surat_detail','surat_detail.id_surat','=','surat.id_surat')
		->leftJoin('users as disposisi','disposisi.id','=','surat_detail.disposisi')
		->leftJoin('klasifikasi_surat','klasifikasi_surat.id_klasifikasi','=','surat_detail.id_klasifikasi')
		->leftJoin('status_surat','status_surat.id_status','=','surat_detail.id_status')
		->where('surat.tipe_surat',$type);
		if (!empty($request->awal)) {
			$data->whereBetween('surat.tanggal_terima',[$request->awal,$request->akhir]);
		}else{
			$data->where('surat.tanggal_terima',date('Y-m-d'));
		}
		// if (Auth::user()->level != 'Admin') {
		// 	$data->where('surat_detail.disposisi',Auth::user()->id);
		// }
		$data = $data->get();
		return $data;
	}
	public static function getEditSurat($id_surat)
	{
		$data = Surat::join('surat_detail','surat_detail.id_surat','=','surat.id_surat')
		->leftJoin('users as disposisi','disposisi.id','=','surat_detail.disposisi')
		->leftJoin('klasifikasi_surat','klasifikasi_surat.id_klasifikasi','=','surat_detail.id_klasifikasi')
		->leftJoin('status_surat','status_surat.id_status','=','surat_detail.id_status')
		->where('surat.id_surat',$id_surat)
		->get();
		return $data;
	}
	public static function getGalerySurat($type)
	{
		$userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login
		$data = Surat::join('surat_detail', 'surat_detail.id_surat', '=', 'surat.id_surat')
			->leftJoin('users as disposisi', 'disposisi.id', '=', 'surat_detail.disposisi')
			->leftJoin('klasifikasi_surat', 'klasifikasi_surat.id_klasifikasi', '=', 'surat_detail.id_klasifikasi')
			->leftJoin('status_surat', 'status_surat.id_status', '=', 'surat_detail.id_status')
			->where('surat.tipe_surat', $type)
			->where('surat_detail.disposisi', $userId) // Filter berdasarkan ID pengguna yang login
			->get();
	
		return $data;
	}
	
	public static function getBukuAgendaSurat($request, $type)
	{
		$data = Surat::join('surat_detail','surat_detail.id_surat','=','surat.id_surat')
		->leftJoin('users as disposisi','disposisi.id','=','surat_detail.disposisi')
		->leftJoin('klasifikasi_surat','klasifikasi_surat.id_klasifikasi','=','surat_detail.id_klasifikasi')
		->leftJoin('status_surat','status_surat.id_status','=','surat_detail.id_status')
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
		$data = Surat::join('surat_detail','surat_detail.id_surat','=','surat.id_surat')
		->leftJoin('users as disposisi','disposisi.id','=','surat_detail.disposisi')
		->leftJoin('klasifikasi_surat','klasifikasi_surat.id_klasifikasi','=','surat_detail.id_klasifikasi')
		->leftJoin('status_surat','status_surat.id_status','=','surat_detail.id_status')
		->select(
			\DB::RAW('surat_detail.ringkasan as ringkasan'),
			\DB::RAW('surat.pengirim as pengirim'),
			\DB::RAW('surat.created_at as created_at')
		)
		->where('surat.tipe_surat','Masuk')
		->where('surat.tanggal_terima',date('Y-m-d'))
		->where('surat_detail.disposisi','!=',NULL)
		->where('surat_detail.disposisi',Auth::user()->id)
		->get();
		return $data;
	}

}
