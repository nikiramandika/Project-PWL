<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('admin.products.products', compact('products'));
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'in_stock' => 'required|boolean',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Simpan gambar jika ada
        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('product_images');
        } else {
            $imagePath = null;
        }
    
        // Buat produk baru dengan data yang diterima dari formulir
        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;
        $product->images = $imagePath;
        $product->save();
    
        // Redirect dengan pesan sukses
        return redirect('/products')->with('successs', 'Data Berhasil Ditambahkan.');
        // return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

}
