<?php


namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function show($order_id)
    {
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->get();
        $address = Address::where('order_id', $order_id)->first();
        $order = Order::with('user')->find($order_id);  // Include user in the query

        return view('invoice', [
            'order_items' => $order_items,
            'address' => $address,
            'order' => $order,
            'user' => $order->user  // Pass the user to the view
        ]);
    }

    public function generate($order_id)
    {
        // Mengambil data order, order items, address, dan user
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->get();
        $address = Address::where('order_id', $order_id)->first();
        $order = Order::with('user')->find($order_id);

        // Mengumpulkan data ke dalam array
        $data = [
            'order_items' => $order_items,
            'address' => $address,
            'order' => $order,
            'user' => $order->user
        ];

        // Menghasilkan PDF dari view 'pdf.invoice' dengan data yang dikumpulkan
        $pdf = Pdf::loadView('invoice', $data);
        return $pdf->download('invoice.pdf');
    }
}
