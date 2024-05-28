<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
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
        $dt = User::find(Auth::user()->id);
        return view('page.profil.index', compact('dt'));
    }

    public function update_my_profil(Request $request)
{
    $user = User::find(Auth::user()->id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->nip = $request->nip;
    $user->telepon = $request->telepon;

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $namaFileBaru = uniqid() . '.' . $foto->getClientOriginalExtension();
        // Move photo to the desired directory
        if ($foto->move(public_path('foto'), $namaFileBaru)) {
            // Save new photo name to user record
            $user->foto = $namaFileBaru;
        } else {
            // If photo saving fails, send error response
            return response()->json(['status' => 'false', 'message' => 'Gagal menyimpan foto.']);
        }
    }

    if (!empty($request->password)) {
        $user->password = Hash::make($request->password);
    }

    // Check if there is a request to delete the current photo
    if ($request->has('hapus_foto') && $request->hapus_foto == '1') {
        // Remove the current photo from the server
        if (File::exists(public_path('foto') . '/' . $user->foto)) {
            File::delete(public_path('foto') . '/' . $user->foto);
        }
        // Clear the photo column in the user record
        $user->foto = null;
        // Save the user record
        $user->save();
        // Return success response
        return response()->json(['status' => 'true', 'message' => 'Foto berhasil dihapus.']);
    }

    // Save the user record
    $user->save();

    // Return success response
    return response()->json(['status' => 'true', 'message' => 'Profil berhasil diedit !!']);
}
}