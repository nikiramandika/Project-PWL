<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.brands', compact(['brands']));
    }
    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'slug' => ['required', 'string', 'min:2'],
            'image' => ['required', 'image'],
            'is_active' => ['required', 'string', 'max:255'],
        ]);

        // Simpan gambar ke folder public/brand dengan nama asli file
        $image = $request->file('image');
        $imagePath = $image->storeAs('public/brand', Str::random(20) . '.' . $image->getClientOriginalExtension());
        // Ubah path agar sesuai dengan direktori publik
        $imagePath = str_replace('public', 'storage', $imagePath);

        // Simpan nama file gambar ke basis data
        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath,
            'is_active' => $request->is_active,
        ]);

        return redirect('/brands-management')->with('successs', 'Data Berhasil Ditambahkan.');
    }



    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brands.edit', compact(['brand']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'slug' => ['required', 'string', 'min:2'],
            'image' => ['required'],
            'is_active' => ['required', 'string', 'max:255'],
        ]);
        $brand = Brand::find($id);
        $brand->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $request->image,
            'is_active' => $request->is_active,
        ]);
        return redirect('/brands-management')->with('successs', 'Data Berhasil Diupdate.');
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect('/brands-management')->with('successs', 'Data Berhasil Dihapus.');
    }
}
