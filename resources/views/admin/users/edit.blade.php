@extends('layouts.user_type.auth')

@section('title', 'Dashboard')
@section('content')
    <div>
        @if ($errors->any())
            <div class="alert bg-gradient-danger mx-4 d-flex align-items-center" role="alert">
                <div class="flex-grow-1 text-white">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <a href="{{ url('user-management') }}" class="btn btn-secondary btn-sm mb-4" type="button">Back</a>
                            <div>
                                <h5 class="mb-0">Edit Brands</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <form action="/user-management/{{ $user->id }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" id="name"
                                    aria-describedby="emailHelp" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="email"
                                    aria-describedby="emailHelp" value="{{ $user->email }}">
                            </div>                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input password="password" type="password" class="form-control" id="passwordInput"
                                    aria-describedby="emailHelp" value="{{ $user->password }}"
                                    oninput="clearDefaultValue(this)">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control" id="role" aria-describedby="emailHelp">
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            


                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function clearDefaultValue(input) {
            // Hapus nilai default saat pengguna mulai mengetik
            input.value = '';
            // Hapus event listener oninput agar nilai default tidak terhapus lagi setelah pengguna mulai mengetik
            input.oninput = null;
        }
    </script>

@endsection
