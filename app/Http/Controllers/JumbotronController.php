<?php

namespace App\Http\Controllers;

use App\Models\Jumbotron;
use Illuminate\Http\Request;

class JumbotronController extends Controller
{
    public function upload(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar ke folder public/images
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('jumbotron'), $imageName);

            // Simpan data ke database
            Jumbotron::create([
                'nama' => $request->nama,
                'gambar' => 'jumbotron/' . $imageName,
            ]);

        return redirect()->route('tambah-jumbotron.jumbotron')->with('success', 'Data berhasil diupload.');
        }

        return back()->with('error', 'Gagal mengupload gambar.');
    }

    public function index(){
        $item = Jumbotron::paginate(10);
        // $item = Product::files(public_path('images'));
        return view('dashboard-admin.jumbotron.index',['item' => $item]);
    }

    public function edit($id)
    {
        $jumbotron = Jumbotron::findOrFail($id);
        return view('dashboard-admin.jumbotron.edit', ['jumbotron' => $jumbotron]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Jumbotron::findOrFail($id);

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Simpan data dengan gambar baru
            $product->update([
                'nama' => $request->nama,
                'gambar' => 'images/' . $imageName,
            ]);
        } else {
            // Simpan data tanpa mengganti gambar
            $product->update([
                'nama' => $request->nama,
            ]);
        }

        return redirect()->route('tambah-jumbotron.jumbotron')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Jumbotron::findOrFail($id);
        $product->delete();

        return redirect()->route('tambah-jumbotron.jumbotron')->with('success', 'Product deleted successfully');
    }
}
