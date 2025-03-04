<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{

    public function index(){
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],[
            'username.required' => ucfirst('username must be filled in'),
            'password.required' => ucfirst('password must be filled in'),
        ]);

        // Menangani login menggunakan autentikasi Laravel
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, alihkan ke halaman home admin
            Alert::success('Success Title', 'Berhasil Masuk!');
            return redirect()->route('dashboard');
        } else {
            // Jika login gagal, kirim pesan error dan kembalikan ke halaman login
            return back()->withErrors([
                'username' => 'These credentials do not match our records.',
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        Alert::success('Success Title', 'Berhasil Keluar!');
        return redirect()->route('index'); 
    }
}
