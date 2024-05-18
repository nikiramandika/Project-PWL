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
                            <a href="{{ url('products-management') }}" class="btn btn-secondary btn-sm mb-4" type="button">Back</a>
                            <div>
                                <h5 class="mb-0">Edit Product</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <form action="/products-management/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="is_active" id="active" value="{{ $product->is_active }}">
                            <input type="hidden" name="is_featured" id="featured" value="{{ $product->is_featured }}">
                            <input type="hidden" name="in_stock" id="stock" value="{{ $product->in_stock }}">
                            <input type="hidden" name="on_sale" id="sale" value="{{ $product->on_sale }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" id="name"
                                    aria-describedby="emailHelp" value="{{ old('name', $product->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input readonly name="slug" type="text" class="form-control" id="slug"
                                    value="{{ old('slug', $product->slug) }}">
                                @error('slug')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="editor" rows="4">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" class="form-select" id="category">
                                    <option selected disabled>Choose...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <select name="brand_id" class="form-select" id="brand">
                                    <option selected disabled>Choose...</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input name="price" type="number" class="form-control" id="price"
                                    aria-describedby="priceHelp" step="0.01" value="{{ old('price', $product->price) }}">
                                <div id="priceHelp" class="form-text">Enter the price of the product.</div>
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" alt="Current Image" class="img-thumbnail mb-2" style="max-width: 150px;">
                                @endif
                                <input name="image" type="file" class="form-control" id="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckActive" {{ $product->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckActive">Active</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckFeatured" {{ $product->is_featured ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckFeatured">Featured</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckStock" {{ $product->in_stock ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckStock">In Stock</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckSale" {{ $product->on_sale ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckSale">On Sale</label>
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

        // Function to handle switch value for Active
        document.getElementById('flexSwitchCheckActive').addEventListener('change', function() {
            document.getElementById('active').value = this.checked ? 1 : 0;
        });

        // Function to handle switch value for Featured
        document.getElementById('flexSwitchCheckFeatured').addEventListener('change', function() {
            document.getElementById('featured').value = this.checked ? 1 : 0;
        });

        // Function to handle switch value for In Stock
        document.getElementById('flexSwitchCheckStock').addEventListener('change', function() {
            document.getElementById('stock').value = this.checked ? 1 : 0;
        });

        // Function to handle switch value for On Sale
        document.getElementById('flexSwitchCheckSale').addEventListener('change', function() {
            document.getElementById('sale').value = this.checked ? 1 : 0;
        });
    </script>
@endsection
