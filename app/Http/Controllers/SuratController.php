<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use Illuminate\Support\Facades\Log;
use Exception;
use DataTables;
use App\Models\KlasifikasiSurat;
use App\Models\StatusSurat;
use PDF;
date_default_timezone_set('Asia/Ujung_Pandang');

class SuratController extends Controller
{
	public function data_surat(Request $request, $type)
	{
		$anggota = Surat::getAnggota();
		$klasifikasi = KlasifikasiSurat::getKlasifikasi();
		$status = StatusSurat::getStatusSurat();
		if ($type == 'masuk') {
			$tipe_surat = 'Masuk';
		}else{
			$tipe_surat = 'Keluar';
		}
		if ($request->ajax()) {
			$data = Surat::getDataSurat($request, $type);
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id_surat.'" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_surat.'" class="btn view btn-secondary text-white rounded-pill btn-sm"><i class="fa fa-eye"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id_surat.'" class="btn delete btn-danger text-white rounded-pill btn-sm"><i class="fa fa-trash"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		if ($type == 'masuk') {
			return view('page.surat_masuk.index',compact('anggota','type','klasifikasi','status','tipe_surat'));
		}else{
			return view('page.surat_keluar.index',compact('anggota','type','klasifikasi','status','tipe_surat'));
		}
	}
	public function save_surat(Request $request)
	{
		try {
			DB::beginTransaction();
			$surat = New Surat();
			$surat -> id_user = Auth::user()->id;
			$surat -> nomor_surat = $request->nomor_surat;
			$surat -> tipe_surat = $request->tipe_surat;
			$surat -> pengirim = $request->pengirim;
			$surat -> nomor_agenda = $request->nomor_agenda;
			$surat -> tanggal_surat = $request->tanggal_surat;
			$surat -> tanggal_terima = $request->tanggal_terima;
			$surat -> save();
			if ($request->tipe_surat == 'Masuk') {
				$disposisi = $request->disposisi;
			}else{
				$disposisi = NULL;
			}
			if (!empty($request->file('lampiran'))) {
				$files = $request->file('lampiran');
				$foto = $files->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $foto;
				$files->move(\base_path() . "/public/lampiran", $namaFileBaru);
			}else{
				$namaFileBaru = NULL;
			}
			DB::table('surat_detail')->insert([
				'id_surat'=>$surat->id_surat,
				'ringkasan'=>$request->ringkasan,
				'disposisi'=>$disposisi,
				'id_klasifikasi' => $request->id_klasifikasi,
				'id_status' => $request->id_status,
				'lampiran_surat'=>$namaFileBaru
			]);
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Surat berhasil ditambahkan !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id_surat)
	{
		$data = Surat::getEditSurat($id_surat);
		return response()->json($data);
	}
	public function update_surat(Request $request)
	{
		try {
			DB::beginTransaction();
			$surat = Surat::where('id_surat',$request->id_surat)->first();
			$surat -> nomor_surat = $request->nomor_surat;
			$surat -> tipe_surat = $request->tipe_surat;
			$surat -> pengirim = $request->pengirim;
			$surat -> nomor_agenda = $request->nomor_agenda;
			$surat -> tanggal_surat = $request->tanggal_surat;
			$surat -> tanggal_terima = $request->tanggal_terima;
			$surat -> save();
			if ($request->tipe_surat == 'Masuk') {
				$disposisi = $request->disposisi;
			}else{
				$disposisi = NULL;
			}
			if (!empty($request->file('lampiran'))) {
				$files = $request->file('lampiran');
				$foto = $files->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $foto;
				$files->move(\base_path() . "/public/lampiran", $namaFileBaru);
			}else{
				$namaFileBaru = $request->lampiranLama;
			}
			DB::table('surat_detail')->where('id_surat',$request->id_surat)->update([
				'id_klasifikasi' => $request->id_klasifikasi,
				'id_status' => $request->id_status,
				'ringkasan'=>$request->ringkasan,
				'disposisi'=>$disposisi,
				'lampiran_surat'=>$namaFileBaru
			]);
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Surat berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function hapus_surat($id_surat)
	{
		try {
			DB::beginTransaction();
			Surat::where('id_surat',$id_surat)->delete();
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Surat berhasil dihapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function galery_surat($type)
	{
		if ($type == 'masuk') {
			$tipe_surat = 'Masuk';
		}else{
			$tipe_surat = 'Keluar';
		}
		$data = Surat::getGalerySurat($type);
		if ($type == 'masuk') {
			$view = 'page.galeri.surat_masuk.index';
		}else{
			$view = 'page.galeri.surat_keluar.index';
		}
		return view($view,compact('data','tipe_surat'));
	}
	public function buku_agenda(Request $request, $type)
	{
		if ($type == 'masuk') {
			$tipe_surat = 'Masuk';
		}else{
			$tipe_surat = 'Keluar';
		}
		$data = Surat::getBukuAgendaSurat($request, $type);
		if ($type == 'masuk') {
			$view = 'page.buku_agenda.surat_masuk.index';
		}else{
			$view = 'page.buku_agenda.surat_keluar.index';
		}
		return view($view,compact('data','tipe_surat','type'));
	}
	public function export_buku_agenda(Request $request, $type)
	{
		$data = Surat::getBukuAgendaSurat($request, $type);
		if ($request->keyword == 'PDF' AND $type == 'masuk') {
			$pdf=PDF::loadview('page.buku_agenda.surat_masuk.export',compact('data'))->setPaper('A4','landscape');
			return $pdf->stream();
		}elseif ($request->keyword == 'Excel' AND $type == 'masuk') {
			return view('page.buku_agenda.surat_masuk.export',compact('data'));
		}elseif ($request->keyword == 'PDF' AND $type == 'keluar') {
			$pdf=PDF::loadview('page.buku_agenda.surat_keluar.export',compact('data'))->setPaper('A4','landscape');
			return $pdf->stream();
		}else{
			return view('page.buku_agenda.surat_keluar.export',compact('data'));
		}
	}
	public function get_notif_surat()
	{
		$data = Surat::getNotifSurat();
		return response()->json($data);
	}
}
