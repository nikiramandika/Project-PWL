<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.user-management', ['users' => $users]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact(['user']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email'],
            'role' => ['required', 'in:admin,user'],
            'password' => ['nullable', 'string', 'min:8'], // Menjadikan password opsional dengan nullable
        ]);

        $user = User::find($id);
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika password baru dimasukkan, hash password baru dan tambahkan ke data pengguna
        if ($request->password) {
            $userData['password'] = bcrypt($request->password);
        }

        // Jika peran yang dipilih adalah "admin", maka atur peran pengguna menjadi "admin"
        if ($request->role === 'admin') {
            $userData['role'] = 'admin';
        }

        $user->update($userData);

        return redirect('/user-management')->with('successs', 'Data Berhasil Diupdate.');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user-management')->with('successs', 'Data Berhasil Dihapus.');
    }
}




