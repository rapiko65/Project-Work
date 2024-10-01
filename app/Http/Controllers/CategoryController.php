<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        Category::create([
            'category' => $request->category,
        ]);

        return redirect()->route('categories.create')->with('success', 'Kategori berhasil ditambahkan');
    }
}
