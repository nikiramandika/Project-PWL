<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
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
            'image' => ['required', 'image'],
            'is_active' => ['required', 'string', 'max:255'],
        ]);

        $image = $request->file('image');
        $imagePath = $image->storeAs('public/categories', Str::random(20) . '.' . $image->getClientOriginalExtension());
        // Ubah path agar sesuai dengan direktori publik
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
            'image' => ['required'],
            'is_active' => ['required', 'string', 'max:255'],
        ]);
        $category = Category::find($id);
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $request->image,
            'is_active' => $request->is_active,
        ]);

        return redirect('/categories-management')->with('successs', 'Data Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/categories-management')->with('successs', 'Data Berhasil Dihapus.');
    }
}
