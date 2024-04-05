<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $credentials = $request->only('email', 'password');
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
    
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status'=>'A'])) {
            $request->session()->regenerate();

                // Jika admin, arahkan ke halaman dashboard
                return redirect(route('dashboard'))->with('success', 'Login successful!');
        }
    
        // Jika login gagal atau pengguna bukan admin, kembalikan pengguna ke halaman login dengan pesan kesalahan
        return back()->with('LoginError', 'Login Failed!.');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
