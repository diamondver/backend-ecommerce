<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $fillable = ['nama_file', 'isCover', 'produk_id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
