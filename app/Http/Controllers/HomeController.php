<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator; 
use Illuminate\Support\Facades\Auth; 

class HomeController extends Controller
{

    public function index()
    {
       
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
    
        // Periksa apakah pengguna sedang login
        if ($user) {
            $nama_pengguna = $user->name;
        } else {
            $nama_pengguna = "Pengguna"; // Atau tampilkan teks default jika pengguna tidak ditemukan
        }
    
        $view = request()->route()->getName() == 'surat.masuk' ? 'transaksi.surat-masuk' : 'transaksi.surat-keluar';

        return view('home.index', [
            'title' => 'home',
            'nama_pengguna' => $nama_pengguna // Mengirimkan nama pengguna ke view
        ]);
    }
    
}
