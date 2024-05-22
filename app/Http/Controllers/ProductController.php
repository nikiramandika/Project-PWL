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
        // Menghilangkan titik dari harga
        $price = str_replace('.', '', $request->price);
        $request->merge(['price' => $price]);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'nullable|string',
            'price' => 'required|min:0',
            'in_stock' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/product', Str::random(20) . '.' . $image->getClientOriginalExtension());
            $imagePath = str_replace('public', 'storage', $imagePath);
        } else {
            $imagePath = null;
        }

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;
        $product->image = $imagePath;
        $product->save();

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

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/product', Str::random(20) . '.' . $image->getClientOriginalExtension());
            $imagePath = str_replace('public', 'storage', $imagePath);
            if ($product->image) {
                Storage::delete(str_replace('storage', 'public', $product->image));
            }
            $product->image = $imagePath;
        }

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

        return redirect('/products-management')->with('successs', 'Data Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->image) {
            Storage::delete(str_replace('storage', 'public', $product->image));
        }
        $product->delete();
        return redirect('/products-management')->with('successs', 'Data Berhasil Dihapus.');
    }
}
