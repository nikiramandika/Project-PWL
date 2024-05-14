<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            // Simpan gambar jika ada
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/product', Str::random(20) . '.' . $image->getClientOriginalExtension());
            // Ubah path agar sesuai dengan direktori publik
            $imagePath = str_replace('public', 'storage', $imagePath);
        } else {
            // Jika tidak ada gambar yang diunggah, atur path gambar ke null
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
        $product->image = $imagePath; // Atur path gambar
        $product->save();

        // Redirect dengan pesan sukses
        return redirect('/products-management')->with('successs', 'Data Berhasil Ditambahkan.');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.edit', compact(['product', 'categories', 'brands']));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari produk berdasarkan ID
        $product = Product::find($id);

        // Jika produk tidak ditemukan, kembalikan response dengan status 404 (Not Found)
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // Update gambar jika ada perubahan
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_image');
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete($product->image);
            }
            $product->image = $imagePath;
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
        return redirect('/products-management')->with('successs', 'Data Berhasil Diupdate.');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products-management')->with('successs', 'Data Berhasil Dihapus.');
    }

}
