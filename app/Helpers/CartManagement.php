<?php

namespace App\Helpers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartManagement
{
    // Menambah item ke cart
    static public function addItemToCart($product_id)
    {
        $user_id = Auth::id();
        $cart_item = CartItem::where('user_id', $user_id)->where('product_id', $product_id)->first();

        if ($cart_item) {
            $cart_item->quantity++;
            $cart_item->total_amount = $cart_item->quantity * $cart_item->unit_amount;
            $cart_item->save();
        } else {
            $product = Product::find($product_id);
            if ($product) {
                CartItem::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'quantity' => 1,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price
                ]);
            }
        }

        return CartItem::where('user_id', $user_id)->count();
    }

    static public function clearCartItems()
    {
        $user_id = Auth::id();
        CartItem::where('user_id', $user_id)->delete();
    }

    static public function addItemToCartWithQty($product_id, $qty = 1)
    {
        $user_id = Auth::id();
        $cart_item = CartItem::where('user_id', $user_id)->where('product_id', $product_id)->first();

        if ($cart_item) {
            $cart_item->quantity += $qty;
            $cart_item->total_amount = $cart_item->quantity * $cart_item->unit_amount;
            $cart_item->save();
        } else {
            $product = Product::find($product_id);
            if ($product) {
                CartItem::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'quantity' => $qty,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price * $qty
                ]);
            }
        }

        return CartItem::where('user_id', $user_id)->count();
    }

    // Mendapatkan jumlah item dalam cart dari database
    static public function getCartItemCountFromDatabase()
    {
        $user_id = Auth::id();
        return CartItem::where('user_id', $user_id)->count();
    }

    // Mengambil item cart dari database
    static public function getCartItemsFromDatabase()
    {
        $user_id = Auth::id();
        return CartItem::where('user_id', $user_id)->get(); // Mengembalikan objek koleksi Eloquent
    }

    // Menghapus item dari cart
    static public function removeCartItem($product_id)
    {
        $user_id = Auth::id();
        CartItem::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        return CartItem::where('user_id', $user_id)->get();
    }

    // Menambah kuantitas item dalam cart
    static public function incrementQuantityToCartItem($product_id)
    {
        $user_id = Auth::id();
        $cart_item = CartItem::where('user_id', $user_id)->where('product_id', $product_id)->first();
        if ($cart_item) {
            $cart_item->quantity++;
            $cart_item->total_amount = $cart_item->quantity * $cart_item->unit_amount;
            $cart_item->save();
        }
        return CartItem::where('user_id', $user_id)->get();
    }

    // Mengurangi kuantitas item dalam cart
    static public function decrementQuantityToCartItem($product_id)
    {
        $user_id = Auth::id();
        $cart_item = CartItem::where('user_id', $user_id)->where('product_id', $product_id)->first();
        if ($cart_item && $cart_item->quantity > 1) {
            $cart_item->quantity--;
            $cart_item->total_amount = $cart_item->quantity * $cart_item->unit_amount;
            $cart_item->save();
        }
        return CartItem::where('user_id', $user_id)->get();
    }

    // Menghitung total keseluruhan dari cart items
    static public function calculateGrandTotal($items)
    {
        return $items->sum('total_amount');
    }
}
