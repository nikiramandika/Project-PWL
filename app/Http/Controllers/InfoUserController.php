<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {
        // Jika pengguna bukan ID 1 dan bukan pengguna yang masuk, kembalikan mereka sebagai tamu
        if (Auth::id() != 1 && Auth::guest()) {
            abort(403, 'Unauthorized action.');
        }
    
        // Validasi input pengguna
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::id())],
            'phone' => ['max:50'],
            'location' => ['max:70'],
            'about_me' => ['max:150'],
        ]);
    
        // Jika email berubah dan pengguna bukan ID 1, kembalikan kesalahan
        if ($request->email != Auth::user()->email && Auth::id() != 1) {
            return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
        }
    
        // Update data pengguna
        User::where('id', Auth::id())->update([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone' => $attributes['phone'],
            'location' => $attributes['location'],
            'about_me' => $attributes["about_me"],
        ]);
    
        return redirect('/user-profile')->with('success', 'Profile updated successfully');
    }
    
}
