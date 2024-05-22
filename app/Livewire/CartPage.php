<?php
namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\CartItem;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Title('Cart - Sm4rtbuy')]
class CartPage extends Component
{

    public $cart_items = [];
    public $grand_total;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromDatabase();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', ['total_count' => CartManagement::getCartItemCountFromDatabase()])->to(\App\Livewire\Partials\Navbar::class);
    }

    public function increaseQty($product_id)
    {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', ['total_count' => CartManagement::getCartItemCountFromDatabase()])->to(\App\Livewire\Partials\Navbar::class);
    }

    public function decreaseQty($product_id)
    {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', ['total_count' => CartManagement::getCartItemCountFromDatabase()])->to(\App\Livewire\Partials\Navbar::class);
    }


    public function render(){
        // Load product data for each cart item
        foreach ($this->cart_items as $index => $item) {
            $this->cart_items[$index]['product'] = CartItem::find($item['id'])->product;
        }
        
        return view('livewire.cart-page');
    }
}
