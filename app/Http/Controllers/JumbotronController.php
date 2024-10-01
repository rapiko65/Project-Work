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
}
