<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CreateController extends Controller
{

        public function create()
        {
          
            $user= User::findOrFail(auth()->id()); // Menggunakan user yang sedang login
        
            // Menggunakan 'name' dari model User, namun Anda harus menyesuaikan dengan nama kolom di tabel database
            $nama_pengguna = $user->name;
        
            return view('suratmasuk.create', [
                'title' => 'create',
                'nama_pengguna' => $nama_pengguna
            ]);
        }
        
    }

