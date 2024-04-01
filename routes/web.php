<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/surat-masuk', function (\Illuminate\Http\Request $request) {
        $nama_pengguna = $request->query('nama_pengguna');
        return view('transaksi.surat-masuk', ['nama_pengguna' => $nama_pengguna]);
    })->name('surat.masuk');   
    Route::get('/surat-keluar', function (\Illuminate\Http\Request $request) {
        $nama_pengguna = $request->query('nama_pengguna');
        return view('transaksi.surat-keluar', ['nama_pengguna' => $nama_pengguna]);
    })->name('surat.keluar');      
});

