<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = ['nama', 'username', 'email', 'password'];

    protected $hidden = ['password'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class);
    }
}
