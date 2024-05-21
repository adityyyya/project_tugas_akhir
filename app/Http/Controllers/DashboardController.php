<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;
use DataTables;
date_default_timezone_set('Asia/Ujung_Pandang');

class DashboardController extends Controller
{
	public function index()
	{
		$surat_masuk = Surat::leftJoin('users','users.id','=','surat.disposisi')
		->where('surat.tanggal_terima',date('Y-m-d'))
		->where('surat.tipe_surat','Masuk');
		// if (Auth::user()->level != 'Admin') {
		// 	$surat_masuk->where('surat_detail.disposisi',Auth::user()->id);
		// }
		$surat_masuk = $surat_masuk->count();
		// ->count();
		$disposisi = Surat::leftJoin('users','users.id','=','surat.disposisi')
		->where('surat.tipe_surat','Masuk')
		->where('surat.tanggal_terima',date('Y-m-d'))
		->where('surat.disposisi','!=',NULL);
		if (Auth::user()->level != 'Admin') {
			$disposisi->where('surat.disposisi',Auth::user()->id);
		}
		$disposisi = $disposisi->count();
		$surat_keluar = Surat::where('tanggal_terima',date('Y-m-d'))
		->where('tipe_surat','Keluar')
		->count();
		$pengguna = User::where('level','!=','Admin')
		->where('status','A')
		->count();
		return view('page.dashboard.index',compact('surat_masuk','surat_keluar','pengguna','disposisi'));
	}
	public function profil()
	{
		$dt = User::getUserProfil();
		return view('page.profil.index',compact('dt'));
	}
	public function update_my_profil(Request $request)
	{
		$user = User::where('id',Auth::user()->id)->first();
		$user -> name = $request->name;
		$user -> email = $request->email;
		if ($request->password != '') {
			$user -> password = hash::make($request->password);
		}
		$user -> save();
		if (!empty($request->file('foto'))) {
			$files = $request->file('foto');
			$foto = $files->getClientOriginalName();
			$namaFileBaru = uniqid();
			$namaFileBaru .= $foto;
			$files->move(\base_path() . "/public/foto", $namaFileBaru);
		}else{
			$namaFileBaru = $request->fotoLama;
		}
		DB::table('biodata')->where('id_user',Auth::user()->id)->update([
			'nip'=>$request->nip,
			'telepon'=>$request->telepon,
			'jenis_kelamin'=>$request->jenis_kelamin,
			'foto'=>$namaFileBaru
		]);
		return response()->json(['status'=>'true','message'=>'Profil berhasil diperbarui !!']);
	}
}
