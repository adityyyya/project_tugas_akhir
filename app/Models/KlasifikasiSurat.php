<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiSurat extends Model
{
    // use HasFactory;
	protected $table="klasifikasi_surat";
	protected $primaryKey="id_klasifikasi";

	public static function getKlasifikasi()
	{
		$data = KlasifikasiSurat::all();
		return $data;
	}
	public static function getEdit($id_klasifikasi)
	{
		$data = KlasifikasiSurat::where('id_klasifikasi',$id_klasifikasi)->get();
		return $data;
	}
}
