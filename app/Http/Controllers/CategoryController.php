<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('dashboard-admin.category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        Category::create([
            'category' => $request->category,
        ]);

        return redirect()->route('tambah-category.category')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function index(){
        $categories = Category::paginate(10);
        return view('dashboard-admin.category.index', compact('categories'));
    }

    public function edit($id){
        $categories = Category::findOrFail($id);
        return view('dashboard-admin.category.edit', ['categories' => $categories]);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);
        $categories =  Category::findOrFail($id);
        $categories->update([
            'category' => $request->category,
        ]);

        return redirect()->route('tambah-category.category')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $product = Category::findOrFail($id);
        $product->delete();

        return redirect()->route('tambah-category.category')->with('success', 'Product deleted successfully');
    }
}
