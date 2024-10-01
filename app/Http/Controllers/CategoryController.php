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

        return redirect()->route('tambah-category.tambah-category')->with('success', 'Kategori berhasil ditambahkan');
    }
}
