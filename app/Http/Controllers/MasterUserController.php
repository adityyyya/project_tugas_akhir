<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;
use DataTables;

class MasterUserController extends Controller
{
	public function data_user(Request $request)
	{
		if ($request->ajax()) {
			$data = User::getUser();
			return DataTables::of($data)
			->addIndexColumn()
			->addColumn('', function($data) {
				$a = '';
				return $a;
			})
			->addColumn('action', function($data) {
				$button = '<a href="javascript:void(0)" more_id="'.$data->id.'" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a> ';
				$button .= '<a href="javascript:void(0)" more_id="'.$data->id.'" class="btn delete btn-danger text-white rounded-pill btn-sm"><i class="fa fa-trash"></i></a> ';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}
		return view('page.user.index');
	}
	public function save_user(Request $request)
	{
		try {
			DB::beginTransaction();
			$user = New User();
			$user -> name = $request->name;
			$user -> email = $request->email;
			$user -> password = hash::make($request->password);
			$user -> level = $request->level;
			$user -> status = $request->status;
			$user -> save();
			if (!empty($request->file('foto'))) {
				$files = $request->file('foto');
				$foto = $files->getClientOriginalName();
				$namaFileBaru = uniqid();
				$namaFileBaru .= $foto;
				$files->move(\base_path() . "/public/foto", $namaFileBaru);
			}else{
				$namaFileBaru = NULL;
			}
			DB::table('biodata')->insert([
				'id_user'=>$user->id,
				'nip'=>$request->nip,
				'jenis_kelamin'=>$request->jenis_kelamin,
				'telepon'=>$request->telepon,
				'foto'=>$namaFileBaru
			]);
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Pengguna berhasil ditambahkan !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function get_edit($id)
	{
		$data = User::getEditUser($id);
		return response()->json($data);
	}
	public function update_user(Request $request)
	{
		try {
			DB::beginTransaction();
			if ($request->password == '') {
				$password = $request->passwordLama;
			}else{
				$password = $request->password;
			}
			$user = User::where('id',$request->id)->first();
			$user -> name = $request->name;
			$user -> email = $request->email;
			$user -> password = hash::make($password);
			$user -> level = $request->level;
			$user -> status = $request->status;
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
			DB::table('biodata')->where('id_user',$request->id)->update([
				'nip'=>$request->nip,
				'jenis_kelamin'=>$request->jenis_kelamin,
				'telepon'=>$request->telepon,
				'foto'=>$namaFileBaru
			]);
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Pengguna berhasil diubah !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
	public function hapus_user($id)
	{
		try {
			DB::beginTransaction();
			User::where('id',$id)->delete();
			DB::commit();
			return response()->json(['status' => 'true', 'message' => 'Data Pengguna berhasil hapus !!']);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e);
			return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
		}
	}
}
