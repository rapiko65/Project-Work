<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jumbotron;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function upload(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'jumlah_barang' => 'required',
            'harga_barang' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Upload gambar ke folder public/images
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Simpan data ke database
            Product::create([
                'nama_barang' => $request->nama_barang,
                'deskripsi_barang' => $request->deskripsi_barang,
                'harga_barang' => $request->harga_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'gambar_barang' => 'images/' . $imageName,
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('tambah-barang.barang')->with('success', 'Data berhasil diupload.');
        }

        return back()->with('error', 'Gagal mengupload gambar.');
    }
    public function index(){
        $item = Product::paginate(10);
        // $item = Product::files(public_path('images'));
        return view('dashboard-admin.tambah-barang.index',['item' => $item]);
    }
    public function show(){
        $jumbotron = Jumbotron::all();
        $products = Product::all();
        // $item = Product::files(public_path('images'));
        // return view('dashboard.index',compact('item','jumbotron'));
        // dd($jumbotron);
        return view('dashboard.index',['products' => $products,'jumbotron' => $jumbotron]);
    }

    public function create(){
        $categories = Category::all();
        return view('dashboard-admin.tambah-barang.create', compact('categories'));

    }
}
