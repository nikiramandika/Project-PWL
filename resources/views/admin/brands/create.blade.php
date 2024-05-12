@extends('layouts.user_type.auth')

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
                            <a href="{{ url('brands') }}" class="btn btn-secondary btn-sm mb-4" type="button">Back</a>
                            <div>
                                <h5 class="mb-0">Add Brands</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <form action="/brands" method="POST">
                            @csrf
                            <input type="hidden" name="is_active" id="active" value="0">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" id="name"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Slug</label>
                                <input readonly name="slug" type="text" id="slug" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input name="image" type="file" class="form-control" id="image">
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Function to generate slug from the given string
        function generateSlug(str) {
            return str.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
        }

        // Function to update slug field when typing in name field
        document.getElementById('name').addEventListener('input', function() {
            var nameValue = this.value;
            var slugValue = generateSlug(nameValue);
            document.getElementById('slug').value = slugValue;
        });

        // Function to handle switch value
        document.getElementById('flexSwitchCheckDefault').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('active').value = 1;
            } else {
                document.getElementById('active').value = 0;
            }
        });
    </script>
@endsection
