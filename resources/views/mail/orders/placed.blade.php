<x-mail::message>
# Order Placed Succesfully!!

Thankyou for your order. Your order nomber is: {{ $order->id }}.

<x-mail::button :url="$url">
View Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
