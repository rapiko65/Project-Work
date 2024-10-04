<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jumbotron;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function edit(Request $request ,$id)
    {
        $product = Product::findOrFail($id);
        $categoryName = $request->input('category_id');

    if ($categoryName) {
        $products = Product::whereHas('category', function ($query) use ($categoryName) {
        $query->where('id', $categoryName);
        })->with('category')->get();
    } else {
        $products = Product::with('category')->get();
    }

    $categories = Category::all();
        return view('dashboard-admin.tambah-barang.edit', compact('product','categories','categoryName'));
    }
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'jumlah_barang' => 'required|integer',
            'harga_barang' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'category_id' => 'required|exists:categories,id',
        ]);

        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Simpan data dengan gambar baru
            $product->update([
                'nama_barang' => $request->nama_barang,
                'deskripsi_barang' => $request->deskripsi_barang,
                'harga_barang' => $request->harga_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'gambar_barang' => 'images/' . $imageName,
                'category_id' => $request->category_id,
            ]);
        } else {
            // Simpan data tanpa mengganti gambar
            $product->update([
                'nama_barang' => $request->nama_barang,
                'deskripsi_barang' => $request->deskripsi_barang,
                'harga_barang' => $request->harga_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'category_id' => $request->category_id,
            ]);
        }

        return redirect()->route('tambah-barang.barang')->with('success', 'Product updated successfully');
    }

    public function index(){
        $item = Product::paginate(10);
        // $item = Product::files(public_path('images'));
        return view('dashboard-admin.tambah-barang.index',['item' => $item]);
    }

    public function show(Request $request){
        $jumbotron = Jumbotron::all();
        $categoryName = $request->input('category_id');

    if ($categoryName) {
        $products = Product::whereHas('category', function ($query) use ($categoryName) {
        $query->where('id', $categoryName);
        })->with('category')->get();
    } else {
        $products = Product::with('category')->get();
    }

    $categories = Category::all();

        return view('dashboard.index',['products' => $products,'jumbotron' => $jumbotron,'categoryName' => $categoryName, 'categories' => $categories ]);

    }

    public function create(){
        $categories = Category::all();
        return view('dashboard-admin.tambah-barang.create', compact('categories'));

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('tambah-barang.barang')->with('success', 'Product deleted successfully');
    }

    public function showpesanan($id){
        $product = Product::findOrFail($id);

        return view('dashboard.pesanan', compact('product'));

    }
}
