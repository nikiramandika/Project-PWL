<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title('Checkout - Sm4rtbuy')]
class CheckoutPage extends Component
{

    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method;


    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromDatabase();
        if (count($cart_items) == 0) {
            return redirect('/products');
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
        ]);

        $cart_items = CartManagement::getCartItemsFromDatabase();

        $line_items = [];

        foreach ($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'idr',
                    'product_data' => [
                        'name' => $item['product']['name'], // Assuming there's a name attribute in your Product model
                    ],
                    'unit_amount' => $item['unit_amount'],
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'idr';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . auth()->user()->name;
        $order->save();

        // Create address
        $address = new Address();
        $address->fill([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
        ]);
        $order->address()->save($address);

        // Create cart items
        $cartItemsData = [];
        foreach ($cart_items as $cartItem) {
            $cartItemsData[] = [
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'unit_amount' => $cartItem['unit_amount'],
                'total_amount' => $cartItem['total_amount'],
            ];
        }
        $order->items()->createMany($cartItemsData);

        CartManagement::clearCartItems();

        // Send email notification
        Mail::to(auth()->user())->send(new OrderPlaced($order));

        // Redirect to success page
        return redirect()->route('success');
    }

    // protected function handleStripePayment($order, $line_items)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));
    //     $sessionCheckout = Session::create([
    //         'payment_method_types' => ['card'],
    //         'customer_email' => auth()->user()->email,
    //         'line_items' => $line_items,
    //         'mode' => 'payment',
    //         'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
    //         'cancel_url' => route('cancel'),
    //     ]);

    //     return $sessionCheckout->url;
    // }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromDatabase();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
