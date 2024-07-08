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
        // Ambil anggota yang bukan petugas dan bukan diri sendiri
        $anggota = Surat::getAnggota()->filter(function($anggota) {
            return $anggota->id !== Auth::id() && $anggota->role !== 'petugas';
        });
        $klasifikasi = KlasifikasiSurat::getKlasifikasi();
        $status = StatusSurat::getStatusSurat();
        $tipe_surat = ($type == 'masuk') ? 'Masuk' : 'Keluar';
    
        if ($request->ajax()) {
            $data = Surat::getDataSurat($request, $type);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('', function($data) {
                    return '';
                })
                ->addColumn('action', function($data) {
                    $button = '<a href="javascript:void(0)" more_id="'.$data->id_surat.'" class="btn view btn-secondary text-white rounded-pill btn-sm"><i class="fa fa-eye"></i></a> ';
                    if ($data->id_user === Auth::id() || Auth::user()->level === 'Admin') {
                        $button .= '<a href="javascript:void(0)" more_id="'.$data->id_surat.'" class="btn edit btn-success text-white rounded-pill btn-sm"><i class="fa fa-edit"></i></a> ';
                        $button .= '<a href="javascript:void(0)" more_id="'.$data->id_surat.'" class="btn delete btn-danger text-white rounded-pill btn-sm"><i class="fa fa-trash"></i></a> ';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        $view = ($type == 'masuk') ? 'page.surat_masuk.index' : 'page.surat_keluar.index';
        return view($view, compact('anggota', 'type', 'klasifikasi', 'status', 'tipe_surat'));
    }
    

    public function save_surat(Request $request)
{
    try {
        DB::beginTransaction();
        $surat = new Surat();
        $surat->id_user = Auth::user()->id;
        $surat->nomor_surat = $request->nomor_surat;
        $surat->tipe_surat = $request->tipe_surat;
        $surat->pengirim = $request->pengirim;
        $surat->tanggal_surat = $request->tanggal_surat;
        $surat->tanggal_terima = $request->tanggal_terima;
        $surat->id_klasifikasi = $request->id_klasifikasi;
        $surat->id_status = $request->id_status;
        $surat->ringkasan = $request->ringkasan;

        // Handle disposisi
        if ($request->tipe_surat == 'Masuk') {
            if ($request->disposisi == Auth::user()->name) {
                return response()->json(['status' => 'false', 'message' => 'Anda tidak dapat mendisposisikan surat kepada diri sendiri.']);
            }
            $surat->disposisi = $request->disposisi;
        } else {
            $surat->disposisi = null;
        }

        // Handle lampiran
        if (!empty($request->file('lampiran'))) {
            $lampiran = $request->file('lampiran');
            $namaFileBaru = uniqid() . '.' . $lampiran->getClientOriginalExtension();
            $lampiran->move(public_path('lampiran'), $namaFileBaru);
            $surat->lampiran_surat = $namaFileBaru;
        } else {
            $surat->lampiran_surat = null;
        }

        $surat->save();
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
    $data = Surat::leftJoin('klasifikasi_surat', 'klasifikasi_surat.id_klasifikasi', '=', 'surat.id_klasifikasi')
                 ->leftJoin('status_surat', 'status_surat.id_status', '=', 'surat.id_status')
                 ->leftJoin('users', 'users.id', '=', 'surat.disposisi')
                 ->select('surat.*', 'klasifikasi_surat.nama_klasifikasi', 'status_surat.nama_status', 'users.name as disposisi_name')
                 ->find($id_surat);

    return response()->json($data);
}
	public function update_surat(Request $request)
{
    try {
        DB::beginTransaction();
        $surat = Surat::find($request->id_surat);
        $surat->nomor_surat = $request->nomor_surat;
        $surat->tipe_surat = $request->tipe_surat;
        $surat->pengirim = $request->pengirim;
        $surat->tanggal_surat = $request->tanggal_surat;
        $surat->tanggal_terima = $request->tanggal_terima;
        $surat->id_klasifikasi = $request->id_klasifikasi;
        $surat->id_status = $request->id_status;
        $surat->ringkasan = $request->ringkasan;
        $surat->disposisi = ($request->tipe_surat == 'Masuk') ? $request->disposisi : null;

        // Handle lampiran
        if (!empty($request->file('lampiran'))) {
            $lampiran = $request->file('lampiran');
            $namaFileBaru = uniqid() . '.' . $lampiran->getClientOriginalExtension();
            $lampiran->move(public_path('lampiran'), $namaFileBaru);
            $surat->lampiran_surat = $namaFileBaru;
        } else {
            $surat->lampiran_surat = $request->lampiranLama;
        }

        $surat->save();
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
    } else {
        $tipe_surat = 'Keluar';
    }
    $data = Surat::getGalerySurat($type);
    
    $anggota = Surat::getAnggota()->filter(function($anggota) {
        return $anggota->id !== Auth::id();
    });

    if ($type == 'masuk') {
        $view = 'page.galeri.surat_masuk.index';
    } else {
        $view = 'page.galeri.surat_keluar.index';
    }

    return view($view, compact('data', 'tipe_surat', 'anggota'));
}

public function editDisposisi(Request $request, $id_surat)
{
    try {
        DB::beginTransaction();

        $surat = Surat::findOrFail($id_surat);
        $surat->disposisi = $request->disposisi;
        $surat->save();

        // Mengubah status notifikasi jika disposisi berubah ke pengguna lain
        if ($surat->disposisi != Auth::user()->id) {
            $surat->notifikasi = 'TIDAK'; // Sesuaikan dengan nilai yang sesuai
            $surat->save();
        }

        DB::commit();

        // Ambil data surat terbaru
        $surat = Surat::findOrFail($id_surat);

        return response()->json([
            'status' => 'true',
            'message' => 'Disposisi berhasil diubah',
            'surat' => $surat // Mengirim data surat terbaru ke frontend
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error($e);
        return response()->json([
            'status' => 'false',
            'message' => 'Permintaan Data terjadi kesalahan !! [' . $e->getMessage() . ']'
        ]);
    }
}   
public function buku_agenda(Request $request, $type)
{
    if ($type == 'masuk') {
        $tipe_surat = 'Masuk';
    }else{
        $tipe_surat = 'Keluar';
    }
    $data = Surat::getBukuAgendaSurat($request, $type);

        $klasifikasi = KlasifikasiSurat::all();
        $status = StatusSurat::all();
        $tipe_surat = 'Semua'; // Default value

    if ($type == 'masuk') {
        $view = 'page.buku_agenda.surat_masuk.index';
    } else {
        $view = 'page.buku_agenda.surat_keluar.index';
    }

    return view($view, compact('data', 'tipe_surat', 'type', 'klasifikasi', 'status'));
}
public function export_buku_agenda(Request $request, $type)
{
    // Memastikan hanya tipe surat yang valid yang bisa diolah
    if ($type != 'masuk' && $type != 'keluar') {
        return redirect()->back()->with('error', 'Tipe surat tidak valid.');
    }

    // Memanggil fungsi untuk mendapatkan data buku agenda surat berdasarkan request dan tipe surat
    $data = Surat::getBukuAgendaSurat($request, $type);

    // Memproses output berdasarkan permintaan format PDF atau tampilan HTML
    if ($request->keyword == 'PDF') {
        if ($type == 'masuk') {
            $pdf = PDF::loadview('page.buku_agenda.surat_masuk.export', compact('data'))->setPaper('A4', 'landscape');
            return $pdf->stream();
        } elseif ($type == 'keluar') {
            $pdf = PDF::loadview('page.buku_agenda.surat_keluar.export', compact('data'))->setPaper('A4', 'landscape');
            return $pdf->stream();
        }
    } else {
        // Jika bukan permintaan PDF, tampilkan tampilan HTML sesuai dengan tipe surat
        if ($type == 'masuk') {
            return view('page.buku_agenda.surat_masuk.export', compact('data'));
        } elseif ($type == 'keluar') {
            return view('page.buku_agenda.surat_keluar.export', compact('data'));
        }
    }
}

public function filterStatus(Request $request)
{
    $klasifikasiId = $request->input('klasifikasi_id');
    $statusId = $request->input('status_id');

    // Log request parameters for debugging
    \Log::info('Klasifikasi ID: ' . $klasifikasiId);
    \Log::info('Status ID: ' . $statusId);

    // Ambil tipe surat dari request jika tersedia
    $type = $request->input('type');

    $query = Surat::query();

    // Tambahkan kondisi tipe surat (masuk atau keluar)
    if ($type == 'masuk') {
        $query->where('surat.tipe_surat', 'masuk');
    } elseif ($type == 'keluar') {
        $query->where('surat.tipe_surat', 'keluar');
    } else {
        // Jika tipe surat tidak valid, kembalikan response kosong atau pesan error sesuai kebutuhan
        return response()->json(['agenda' => []]);
    }

    if ($klasifikasiId) {
        $query->where('surat.id_klasifikasi', $klasifikasiId);
    }

    if ($statusId) {
        $query->where('surat.id_status', $statusId);
    }

    // Inner join dengan tabel klasifikasi_surat dan status_surat untuk mendapatkan nama klasifikasi dan status
    $query->join('klasifikasi_surat', 'klasifikasi_surat.id_klasifikasi', '=', 'surat.id_klasifikasi')
          ->join('status_surat', 'status_surat.id_status', '=', 'surat.id_status')
          ->leftJoin('users', 'users.id', '=', 'surat.disposisi')
          ->select('surat.*', 'klasifikasi_surat.nama_klasifikasi', 'status_surat.nama_status', 'users.name as disposisi_name');

    // Jika ingin mendapatkan data yang unik berdasarkan ID surat, tambahkan distinct
    $data = $query->distinct()->get();

    // Log the resulting data for debugging
    \Log::info($data);

    // Tentukan view berdasarkan tipe surat
    return response()->json(['agenda' => $data]);
}




	public function get_notif_surat()
	{
		$data = Surat::getNotifSurat();
		return response()->json($data);
	}
    public function updateNotif($id)
    {
        $surat = Surat::findOrFail($id);
        
        // Periksa apakah pengguna adalah penerima disposisi
        if ($surat->disposisi == Auth::user()->id) {
            $surat->notifikasi = 'YA';
            $surat->save();
        
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
        
    
	
}

