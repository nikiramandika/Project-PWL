<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('user')->get();
        return view('admin.orders.orders',compact(['orders']));
    }

    public function create(){
        return view('admin.orders.create')->with('successs', 'Data Berhasil Ditambahkan.');
    }
}
