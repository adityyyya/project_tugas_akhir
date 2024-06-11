<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MasterUserController;


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
Route::post('login', [LoginController::class, 'authenticate'])->name('cek_login')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->prefix('page')->group(function() {
    // Route::get('home', [HomeController::class, 'index'])->name('home');
	Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // data surat
	Route::get('surat_{type}', [SuratController::class, 'data_surat'])->name('data.surat');
	Route::post('surat/save', [SuratController::class, 'save_surat'])->name('save.surat');
	Route::get('surat/get_edit/{id_surat}', [SuratController::class, 'get_edit'])->name('get_edit');
	Route::post('surat/update', [SuratController::class, 'update_surat'])->name('update.surat');
	Route::get('surat/destroy/{id_surat}', [SuratController::class, 'hapus_surat']);
    // klasifikasi surat
	Route::get('klasifikasi_surat', [MasterController::class, 'data_klasifikasi'])->name('data_klasifikasi');
	Route::post('klasifikasi_surat/save', [MasterController::class, 'save_klasifikasi'])->name('save_klasifikasi');
	Route::get('klasifikasi_surat/get_edit/{id_klasifikasi}', [MasterController::class, 'get_edit_klasifikasi'])->name('get_edit_klasifikasi');
	Route::get('klasifikasi_surat/destroy/{id_klasifikasi}', [MasterController::class, 'hapus_klasifikasi']);
    // Status surat
	Route::get('status_surat', [MasterController::class, 'data_status'])->name('data_status');
	Route::post('status_surat/save', [MasterController::class, 'save_status'])->name('save_status');
	Route::get('status_surat/get_edit/{id_status}', [MasterController::class, 'get_edit_status'])->name('get_edit_status');
	Route::get('status_surat/destroy/{id_status}', [MasterController::class, 'hapus_status']);
	// user pengguna
	Route::get('user_pengguna', [MasterUserController::class, 'data_user'])->name('data_user');
	Route::post('user_pengguna/save', [MasterUserController::class, 'save_user'])->name('save_user');
	Route::get('user_pengguna/get_edit/{id}', [MasterUserController::class, 'get_edit']);
	Route::post('user_pengguna/update', [MasterUserController::class, 'update_user'])->name('update_user');
	Route::get('user_pengguna/destroy/{id}', [MasterUserController::class, 'hapus_user']);
	// galery
	Route::get('galery/surat_{type}', [SuratController::class, 'galery_surat'])->name('galery_surat');
	Route::post('surat/edit_disposisi/{id_surat}', [SuratController::class, 'editDisposisi'])->name('edit_disposisi');
	// buku agenda
	Route::get('buku_agenda/surat_{type}', [SuratController::class, 'buku_agenda'])->name('buku_agenda');
	Route::get('buku_agenda/surat_{type}/export', [SuratController::class, 'export_buku_agenda'])->name('export_buku_agenda');
	// get notifikasi
	Route::get('get_notif_surat', [SuratController::class, 'get_notif_surat'])->name('get_notif_surat');
	Route::get('update_notif_surat/{id}', [SuratController::class, 'updateNotif'])->name('update_notif_surat');
	// profile
	Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');
	Route::post('/update_my_profil', [DashboardController::class, 'update_my_profil'])->name('update_my_profil');
});

