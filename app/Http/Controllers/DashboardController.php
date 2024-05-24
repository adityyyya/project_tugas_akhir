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
    $user = User::find(Auth::user()->id);
    $user->name = $request->name;
    $user->email = $request->email;
    
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $namaFileBaru = uniqid() . '.' . $foto->getClientOriginalExtension();
        // Pindahkan foto ke direktori yang diinginkan
        if ($foto->move(public_path('foto'), $namaFileBaru)) {
            // Simpan nama foto baru ke dalam record user
            $user->foto = $namaFileBaru;
        } else {
            // Jika gagal menyimpan foto, kirim respons error
            return response()->json(['status' => 'false', 'message' => 'Gagal menyimpan foto.']);
        }
    }

    if (!empty($request->password)) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return response()->json(['status' => 'true', 'message' => 'Profil berhasil diperbarui !!']);
}

}
