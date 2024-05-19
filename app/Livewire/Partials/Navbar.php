<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $total_count = 0;

    public function mount()
    {
        $this->loadCartCount();
    }

    #[On('update-cart-count')]
    public function loadCartCount()
    {
        $this->total_count = CartManagement::getCartItemCountFromDatabase();
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
