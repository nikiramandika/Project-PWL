@extends('layouts.user_type.auth')

@section('content')
    <div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <a href="{{ url('orders') }}" class="btn btn-secondary btn-sm mb-4" type="button">Back</a>
                            <div>
                                <h5 class="mb-0">View Order</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <!-- Tampilkan informasi pesanan -->
                        <p>Nama Pelanggan: {{ $order->user->name }}</p>
                        <p>Tanggal Pesanan: {{ $order->created_at }}</p>

                        <!-- Tampilkan daftar item pesanan -->
                        <h5>Item Pesanan:</h5>
                        <ul>
                            @foreach ($orderItems as $item)
                                <li>{{ $item->product->name }} - Jumlah: {{ $item->quantity }}</li>
                            @endforeach
                        </ul>

                        <h5>Alamat Pengiriman:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Nama: {{ $address->first_name }} {{ $address->last_name }}</p>
                                <p>Alamat: {{ $address->street_address }}</p>
                                <p>Provinsi: {{ $address->state }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>Telepon: {{ $address->phone }}</p>
                                <p>Kota: {{ $address->city }}</p>
                                <p>Kode Pos: {{ $address->zip_code }}</p>
                            </div>
                        </div>
                        
                        
                        <form action="/orders/{{ $order->id }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control" id="status" aria-describedby="emailHelp">
                                    <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>New</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
