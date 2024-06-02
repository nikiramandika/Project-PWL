<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfilePage extends Component
{
    public $user;
    public $name;

    public function mount()
    {
        // Mendapatkan pengguna yang sedang login
        $this->user = Auth::user();

        // Set nilai awal input "name" dengan nama pengguna yang sedang login
        $this->name = $this->user->name;
    }

    public function updateProfile()
    {
        // Validasi untuk perubahan nama
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        // Memperbarui nama pengguna
        $this->user->name = $this->name; // Menggunakan $this->name
        $this->user->save();

        return redirect()->route('edit-profile')->with('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }

    public function deleteAccount()
    {
        // Hapus pengguna yang sedang login
        $this->user->delete();

        // Logout pengguna setelah menghapus akun
        Auth::logout();

        // Redirect pengguna ke halaman beranda atau halaman lain yang sesuai setelah menghapus akun
        return redirect()->to('/login')->with('success', 'Your account has been deleted.');
    }

}
