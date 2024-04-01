<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $nama_pengguna = auth()->user()->name;
        return view('dashboard.index', ['nama_pengguna' => $nama_pengguna]);
    }
}
