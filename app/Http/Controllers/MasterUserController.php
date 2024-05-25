<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;
use DataTables;

class MasterUserController extends Controller
{
    public function data_user(Request $request)
{
    if ($request->ajax()) {
        $data = User::where('level', '!=', 'admin')->get(); // Exclude users with level 'admin'
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = '<a href="javascript:void(0)" more_id="' . $data->id . '" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a> ';
                $button .= '<a href="javascript:void(0)" more_id="' . $data->id . '" class="btn delete btn-danger text-white rounded-pill btn-sm"><i class="fa fa-trash"></i></a> ';
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
        // Validasi data disini

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->nip = $request->nip;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->telepon = $request->telepon;

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Menambahkan validasi untuk file foto
            ]);
            $foto = $request->file('foto');
            $namaFileBaru = uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('foto'), $namaFileBaru);
            $user->foto = $namaFileBaru;
        } else {
            $user->foto = null;
        }

        $user->level = $request->level;
        $user->status = $request->status;

        $user->save();

        return response()->json(['status' => 'true', 'message' => 'Data Pengguna berhasil ditambahkan !!']);
    } catch (\Exception $e) {
        Log::error($e);
        return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
    }
}

public function update_user(Request $request)
{
    try {
        // Validasi data disini

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->nip = $request->nip;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->telepon = $request->telepon;

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Menambahkan validasi untuk file foto
            ]);
            $foto = $request->file('foto');
            $namaFileBaru = uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('foto'), $namaFileBaru);
            $user->foto = $namaFileBaru;
        }

        $user->level = $request->level;
        $user->status = $request->status;

        $user->save();

        return response()->json(['status' => 'true', 'message' => 'Data Pengguna berhasil diubah !!']);
    } catch (\Exception $e) {
        Log::error($e);
        return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
    }
}
public function get_edit($id)
{
    try {
        $user = User::findOrFail($id); // Mengambil data pengguna berdasarkan ID

        // Mengirim data pengguna dalam bentuk JSON
        return response()->json([
            'status' => 'true',
            'data' => $user
        ]);
    } catch (\Exception $e) {
        Log::error($e);
        return response()->json([
            'status' => 'false',
            'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']'
        ]);
    }
}

    public function hapus_user($id)
    {
        try {
            User::findOrFail($id)->delete(); // Menghapus data pengguna berdasarkan ID
            return response()->json(['status' => 'true', 'message' => 'Data Pengguna berhasil dihapus !!']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['status' => 'false', 'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']']);
        }
    }
}
