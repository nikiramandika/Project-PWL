<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function edit($id)
    {
        $product = Product::find($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.edit', compact(['product','categories', 'brands']));
    }

public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug,' . $id,
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'in_stock' => 'required|boolean',
        'is_active' => 'required|boolean',
        'on_sale' => 'required|boolean',
        'is_featured' => 'required|boolean',
        'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Cari produk berdasarkan ID
    $product = Product::find($id);

    // Jika produk tidak ditemukan, kembalikan response dengan status 404 (Not Found)
    if (!$product) {
        return response()->json(['message' => 'Product not found.'], 404);
    }

    // Update gambar jika ada perubahan
    if ($request->hasFile('images')) {
        $imagePath = $request->file('images')->store('product_images');
        // Hapus gambar lama jika ada
        if ($product->images) {
            Storage::delete($product->images);
        }
        $product->images = $imagePath;
    }

    // Update data produk dengan data yang diterima dari formulir
    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->in_stock = $request->in_stock;
    $product->is_active = $request->is_active;
    $product->is_featured = $request->is_featured;
    $product->on_sale = $request->on_sale;
    $product->save();

    // Redirect dengan pesan sukses
    return redirect('/products')->with('successs', 'Data Berhasil Diupdate.');
}


}
