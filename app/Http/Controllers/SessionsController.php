<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Dapatkan kredensial pengguna dari permintaan
        $credentials = $request->only('email', 'password');

        // Lakukan proses otentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Dapatkan informasi pengguna yang berhasil login
            $user = Auth::user();

            // Periksa peran pengguna
            if ($user->role === 'admin') {
                return redirect()->route('dashboard'); // Mengarahkan ke dashboard jika peran adalah admin
            } else {
                return redirect()->route('user.page'); // Mengarahkan ke halaman selamat datang untuk peran selain admin
            }
        }

        // Jika otentikasi gagal, kembali ke halaman login dengan pesan kesalahan
        return redirect()->route('login')->withErrors(['error' => 'Email atau password yang Anda masukkan salah']);
    }

    public function destroy()
    {
        // Lakukan proses logout pengguna
        Auth::logout();

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
