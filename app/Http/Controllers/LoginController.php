<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Don't forget to import the User model if you haven't already

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userId = Auth::id(); // Mendapatkan ID pengguna yang login
            session(['userId' => $userId]); // Menyimpan ID pengguna dalam sesi

            // Jika admin, arahkan ke halaman dashboard
            return redirect(route('dashboard'))->with('welcome', true);
        } else {
            // Jika login gagal, tampilkan pesan kesalahan sesuai kondisi
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('LoginError', 'Alamat email salah.');
            } elseif (!Hash::check($request->password, $user->password)) {
                return back()->with('LoginError', 'Password salah.');
            } else {
                return back()->with('LoginError', 'Gagal login. Silakan coba lagi.');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
