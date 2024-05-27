<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #ffffff;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        color: #333;
        margin: 0;
    }

    .invoice-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .invoice-info span {
        font-size: 14px;
        color: #666;
    }

    .invoice-info span strong {
        color: #333;
    }

    .table-container {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        word-break: break-all;
    }

    .table th {
        background-color: #f2f2f2;
        color: #333;
    }

    .table td {
        background-color: #fff;
        color: #666;
    }

    .total {
        margin-top: 20px;
        text-align: right;
    }

    .total strong {
        color: #333;
    }

    .thank-you {
        text-align: center;
        margin-top: 20px;
        color: #666;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Sm4rtbuy Invoice</h1>
        <span>Date Invoice : <strong>{{ now()->format('d / m / Y') }}</strong></span><br>
    </div>
    <div class="invoice-info">
        <div>
            <span>Order Id : <strong>{{ $order->id }}</strong></span><br>
            <span>Order Date : <strong>{{ $order->created_at->format('d-m-Y h:i A') }}</strong></span><br>
            <span>Payment Method : <strong>{{ $order->payment_method ?? 'N/A'}}</strong></span><br>
            <span>Address : <strong>{{ $address->street_address ?? 'N/A' }}, {{ $address->city ?? 'N/A' }},
                    {{ $address->state ?? 'N/A' }} </strong></span><br>
            <span>Zip Code : <strong>{{ $address->zip_code ?? 'N/A' }}</strong></span><br>
        </div>
    </div>

    <!-- Data Order -->
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Order Status</th>
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $address->full_name ?? 'N/A' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $address->phone ?? 'N/A' }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->payment_method }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- End Data Order -->

    <br>

    <!-- Table Order Items -->
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ Number::currency($item->unit_amount, 'IDR') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ Number::currency($item->total_amount, 'IDR') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4"><strong>Total Amount (Inc. all vat/tax):</strong></td>
                    <td><strong>{{ Number::currency($order->grand_total, 'IDR') }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- End Table Order Items -->

    <p class="thank-you">Thank you for shopping with Sm4rtbuy.</p>
</div>
