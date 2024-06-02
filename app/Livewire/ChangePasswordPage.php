<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePasswordPage extends Component
{
    public $user;
    public $current_password;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        // Mendapatkan pengguna yang sedang login
        $this->user = Auth::user();
    }

    public function changePassword()
    {
        // Validasi untuk perubahan kata sandi
        $this->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                // Custom validation rule to check if new password is different from the current password
                function ($attribute, $value, $fail) {
                    if (Hash::check($value, $this->user->password)) {
                        $fail('The new password must be different from the current password.');
                    }
                },
            ],
        ]);

        // Memeriksa apakah password lama yang dimasukkan benar
        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }

        // Memperbarui password pengguna
        $this->user->password = Hash::make($this->password);
        $this->user->save();

        return redirect()->route('change-password')->with('success_message', 'Password changed successfully!');
    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
