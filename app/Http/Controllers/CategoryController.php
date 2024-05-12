<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.categories.categories',compact(['categories']));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'slug' => ['required', 'string', 'min:2'],
            'image' => ['required'],
            'is_active' => ['required', 'string', 'max:255'],
        ]);

        Category::create([
            'name'=> $request->name,
            'slug'=> $request->slug,
            'image'=> $request->image,
            'is_active'=> $request->is_active,
        ]);

        return redirect('/categories')->with('successs', 'Data Berhasil Ditambahkan.');
    }
}
