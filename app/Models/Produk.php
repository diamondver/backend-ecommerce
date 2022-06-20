<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama_produk', 'stok', 'harga'];

    public function produk_keranjang()
    {
        return $this->hasMany(Produk_Keranjang::class);
    }

    public function detail_transaksi()
    {
        return $this->hasMany(Detail_Transaksi::class);
    }

    public function gambar()
    {
        return $this->hasMany(Gambar::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }
}
