<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.orders', compact(['orders']));
    }
    public function view($orderId)
    {
        // Ambil pesanan berdasarkan ID
        $order = Order::with('user')->findOrFail($orderId);
    
        // Ambil semua item pesanan terkait dengan pesanan ini
        $orderItems = OrderItem::where('order_id', $orderId)->get();
        
        // Ambil alamat pengiriman terkait dengan pesanan ini
        $address = Address::where('order_id', $orderId)->first();
    
        // Teruskan data pesanan, item pesanan, dan alamat pengiriman ke view
        return view('admin.orders.view', compact('order', 'orderItems', 'address'));
    }
    

    public function update(Request $request, $orderId)
    {
        // Validasi request
        $request->validate([
            'status' => 'required|in:new,shipped,delivered,cancelled',
        ]);

        // Cari pesanan berdasarkan ID
        $order = Order::findOrFail($orderId);

        // Perbarui status pesanan
        $order->status = $request->status;
        $order->save();

        return redirect('/orders')->with('successs', 'Data Berhasil Diupdate.');
    }


    public function create()
    {
        return view('admin.orders.create')->with('successs', 'Data Berhasil Ditambahkan.');
    }

    public function destroy($orderId)
    {
        $order = Order::find($orderId);
        $order->delete();
        return redirect('/orders')->with('successs', 'Data Berhasil Dihapus.');
    }
}
