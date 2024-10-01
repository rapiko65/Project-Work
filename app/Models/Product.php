<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =['nama_barang','deskripsi_barang','jumlah_barang','gambar_barang','harga_barang'];
    public function category()
{
    return $this->belongsTo(Category::class);
}

}
