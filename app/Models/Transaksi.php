<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'alamat_id', 'total_harga'];

    public function user()
    {
        return $this->belongsTo(Gambar::class);
    }

    public function detail_transaksi()
    {
        return $this->hasMany(Detail_Transaksi::class);
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }
}
