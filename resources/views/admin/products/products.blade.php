@extends('layouts.user_type.auth')

@section('content')
    <div>
        <style>
            .alert {
                transition: opacity 0.5s ease;
            }
        </style>

        @if (session()->has('successs'))
            <div id="success-alert" class="alert alert-secondary mx-4" role="alert">
                <span class="text-white">
                    {{ session('successs') }}
                </span>
            </div>
        @endif

        <script>
            // Ambil elemen alert
            var alert = document.getElementById('success-alert');

            // Set opacity menjadi 0
            alert.style.opacity = '0';

            // Hapus elemen alert setelah 4 detik
            setTimeout(function() {
                alert.style.opacity = '1'; // Ubah opacity menjadi 1
                setTimeout(function() {
                    alert.style.opacity = '0'; // Kembali ubah opacity menjadi 0
                    setTimeout(function() {
                        alert.remove(); // Hapus elemen alert
                    }, 500); // Waktu transisi (500ms = 0.5 detik)
                }, 4000); // Waktu alert ditampilkan (4000ms = 4 detik)
            }, 100); // Tunda sebentar sebelum memulai transisi (100ms = 0.1 detik)
        </script>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Products</h5>
                            </div>
                            <a href="{{ url('products-management/create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                type="button">+&nbsp; New Product</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-0">
                        <div class="table-responsive p-0 card-body-table">
                            <table class="table align-items-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Image
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Brand
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Price
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Stock
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Sale
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Active
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Featured
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $product->category->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <div>
                                                    <img src="{{ asset($product->image) }}" class="avatar avatar-sm me-3">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $product->brand->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $product->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    
                                                    <a href="/products-management/{{ $product->id }}/edit" class=""data-bs-toggle="tooltip" >{{Str::limit($product->description, 15, "...") }}</a>
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">Rp.{{ $product->price }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $product->in_stock ? 'On' : 'Off' }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $product->on_sale ? 'On' : 'Off' }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $product->is_active ? 'On' : 'Off' }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $product->is_featured ? 'On' : 'Off' }}</span>
                                            </td>

                                            <td class="text-center">
                                                <a href="/products-management/{{ $product->id }}/edit" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <span>
                                                    <form id="delete-form-{{ $product->id }}"
                                                        action="/products-management/{{ $product->id }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="#" class="mx-3"
                                                            onclick="deleteProduct({{ $product->id }})"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                        </a>
                                                    </form>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                event.preventDefault();
                document.getElementById('delete-form-' + productId).submit();
            }
        }
    </script>
@endsection
