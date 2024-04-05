<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusSurat extends Model
{
    // use HasFactory;
	protected $table="status_surat";
	protected $primaryKey="id_status";

	public static function getStatusSurat()
	{
		$data = StatusSurat::all();
		return $data;
	}
	public static function getEdit($id_status)
	{
		$data = StatusSurat::where('id_status',$id_status)->get();
		return $data;
	}
}
