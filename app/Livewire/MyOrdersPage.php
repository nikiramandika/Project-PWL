<?php

// app/Livewire/MyOrdersPage.php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Order - Sm4rtbuy')]
class MyOrdersPage extends Component
{
    public function render()
    {
        $my_orders = Order::with('items.product')->where('user_id', auth()->id())->latest()->paginate(5);
        return view('livewire.my-orders-page', [
            'orders' => $my_orders,
        ]);
    }
}

