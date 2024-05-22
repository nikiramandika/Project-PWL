<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.categories', compact(['categories']));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'slug' => ['required', 'string', 'min:2'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_active' => ['required', 'string', 'max:255'],
        ]);

        $image = $request->file('image');
        $imagePath = $image->storeAs('public/categories', Str::random(20) . '.' . $image->getClientOriginalExtension());
        $imagePath = str_replace('public', 'storage', $imagePath);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath,
            'is_active' => $request->is_active,
        ]);

        return redirect('/categories-management')->with('successs', 'Data Berhasil Ditambahkan.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact(['category']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'slug' => ['required', 'string', 'min:2'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_active' => ['required', 'string', 'max:255'],
        ]);

        $category = Category::find($id);

        if (!$category) {
            return redirect('/categories-management')->with('error', 'Category not found.');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->storeAs('public/categories', Str::random(20) . '.' . $image->getClientOriginalExtension());
            $imagePath = str_replace('public', 'storage', $imagePath);

            // Hapus gambar lama jika ada
            if ($category->image) {
                Storage::delete(str_replace('storage', 'public', $category->image));
            }

            // Perbarui path gambar
            $category->image = $imagePath;
        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->is_active = $request->is_active;
        $category->save();

        return redirect('/categories-management')->with('successs', 'Data Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect('/categories-management')->with('error', 'Category not found.');
        }

        if ($category->image) {
            Storage::delete(str_replace('storage', 'public', $category->image));
        }

        $category->delete();
        return redirect('/categories-management')->with('successs', 'Data Berhasil Dihapus.');
    }
}
