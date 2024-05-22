@extends('layouts.user_type.auth')

@section('title', 'Dashboard')
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
                                <h5 class="mb-0">All Orders</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 card-body-table">
                        <div class="table-responsive p-0">
                            <div class="card-body">
                                <table id="myTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                User
                                            </th>
                                            <th
                                                class=" text-uppercase  text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Grand total
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Payment Status
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Shipping Method
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Notes
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="ps-4">
                                                    <a href="orders-management/{{ $order->id }}/view"
                                                        class="text-xs font-weight-bold mb-0">{{ $order->user->name }}</a>
                                                </td>

                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ Number::currency($order->grand_total, 'IDR') }}</p>
                                                </td>
                                                {{-- <td>
                                        <div>
                                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td> --}}
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $order->payment_status }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $order->status }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">JNE Reguler</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->notes }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="/orders-management/{{ $order->id }}/view" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="View user">
                                                        <i class="fas fa-eye text-secondary"></i>
                                                    </a>
                                                    <span>
                                                        <form id="delete-form-{{ $order->id }}"
                                                            action="/orders-management/{{ $order->id }}" method="POST"
                                                            style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="#" class="mx-3"
                                                                onclick="deleteOrder({{ $order->id }})"
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
    </div>
    <script>
        function deleteOrder(orderId) {
            if (confirm('Are you sure you want to delete this order?')) {
                event.preventDefault();
                document.getElementById('delete-form-' + orderId).submit();
            }
        }
    </script>
@endsection
