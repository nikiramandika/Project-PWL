<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_user(){
        $users = User::all();
        return view('laravel-examples.user-management',compact(['users']));
    }
    public function view_brand(){
        $brands = Brand::all();
        return view('laravel-examples.brands',compact(['brands']));
    }
    public function view_category(){
        $categories = Category::all();
        return view('laravel-examples.categories',compact(['categories']));
    }
    public function view_product(){
        $products = Product::with(['category', 'brand'])->get();
        return view('laravel-examples.Products', compact('products'));
    }
    public function view_order(){
        $orders = Order::with('user')->get();
        return view('laravel-examples.orders',compact(['orders']));
    }
}
