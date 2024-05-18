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
                            <a href="{{ url('categories-management') }}" class="btn btn-secondary btn-sm mb-4" type="button">Back</a>
                            <div>
                                <h5 class="mb-0">Edit Category</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <form action="/categories-management/{{ $category->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="is_active" id="active" value="{{ $category->is_active }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" id="name"
                                    aria-describedby="emailHelp" value="{{ $category->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Slug</label>
                                <input readonly name="slug" type="text" value="{{ $category->slug }}" id="slug"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                @if ($category->image)
                                    <img src="{{ asset($category->image) }}" alt="Current Image" class="img-thumbnail mb-2" style="max-width: 150px;">
                                @endif
                                <input name="image" type="file" class="form-control" id="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                    @if ($category->is_active) checked @endif>
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
        document.addEventListener("DOMContentLoaded", function() {
            var switchElement = document.getElementById('flexSwitchCheckDefault');
            var activeInput = document.getElementById('active');

            switchElement.addEventListener('change', function() {
                if (this.checked) {
                    activeInput.value = 1;
                } else {
                    activeInput.value = 0;
                }
            });
        });
    </script>

@endsection
