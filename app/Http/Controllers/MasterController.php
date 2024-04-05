<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\KlasifikasiSurat;
use App\Models\StatusSurat;
use Illuminate\Support\Facades\Log;
use Exception;
use DataTables;

class MasterController extends Controller
{
	public function data_klasifikasi(Request $request)
	{
		if ($request->ajax()) {
			$data = KlasifikasiSurat::getKlasifikasi();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_klasifikasi.'" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_klasifikasi.'" class="btn delete btn-danger text-white rounded-pill btn-sm"><i class="fa fa-trash"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.klasifikasi_surat.index');
	}
	public function save_klasifikasi(Request $request)
	{
		try {
			DB::beginTransaction();
			if ($request->id_klasifikasi == '') {
				$data = New KlasifikasiSurat();
			}else{
				$data = KlasifikasiSurat::where('id_klasifikasi',$request->id_klasifikasi)->first();
			}
			$data -> nama_klasifikasi = $request->nama_klasifikasi;
			$data -> save();
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Klasifikasi Surat berhasil !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit_klasifikasi($id_klasifikasi)
	{
		$data = KlasifikasiSurat::getEdit($id_klasifikasi);
		return response()->json($data);
	}
	public function hapus_klasifikasi($id_klasifikasi)
	{
		try {
			DB::beginTransaction();
			$data = KlasifikasiSurat::where('id_klasifikasi',$id_klasifikasi)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Klasifikasi Surat berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function data_status(Request $request)
	{
		if ($request->ajax()) {
			$data = StatusSurat::getStatusSurat();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_status.'" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_status.'" class="btn delete btn-danger text-white rounded-pill btn-sm"><i class="fa fa-trash"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.status_surat.index');
	}
	public function save_status(Request $request)
	{
		try {
			DB::beginTransaction();
			if ($request->id_status == '') {
				$data = New StatusSurat();
			}else{
				$data = StatusSurat::where('id_status',$request->id_status)->first();
			}
			$data -> nama_status = $request->nama_status;
			$data -> save();
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Status Surat berhasil !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit_status($id_status)
	{
		$data = StatusSurat::getEdit($id_status);
		return response()->json($data);
	}
	public function hapus_status($id_status)
	{
		try {
			DB::beginTransaction();
			$data = StatusSurat::where('id_status',$id_status)->first();
			$data -> delete();
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Status Surat berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
