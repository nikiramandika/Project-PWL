<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password']);
        // Set default role here, you can adjust as needed
        $attributes['role'] = 'user'; 

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        
        // Redirect to login page after account creation
        return redirect('/login')->with('success', 'Your account has been created. Please login.');
    }
}
