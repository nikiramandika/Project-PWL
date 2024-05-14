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
                                <h5 class="mb-0">All Categories</h5>
                            </div>
                            <a href="{{ url('categories-management/create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                type="button">+&nbsp; New
                                Category</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 card-body-table">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Photo
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Slug
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Is Active
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created_at
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Updated At
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $category->id }}</p>
                                            </td>
                                            <td>
                                                <div>
                                                    <img src="{{ asset( $category->image) }}" class="avatar avatar-sm me-3">
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $category->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $category->slug }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $category->is_active ? 'On' : 'Off' }}</p>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $category->created_at }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $category->updated_at }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="/categories-management/{{ $category->id }}/edit" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Edit category">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>

                                                <span>
                                                    <form id="delete-form-{{ $category->id }}"
                                                        action="/categories-management/{{ $category->id }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="#" class="mx-3"
                                                            onclick="deleteCategory({{ $category->id }})"
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
        function deleteCategory(categoryId) {
            if (confirm('Are you sure you want to delete this category?')) {
                event.preventDefault();
                document.getElementById('delete-form-' + categoryId).submit();
            }
        }
    </script>
@endsection
