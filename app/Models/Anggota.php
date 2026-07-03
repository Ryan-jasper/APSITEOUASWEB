<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Anggota extends Authenticatable
{
    protected $table = 'anggotas';
    protected $primaryKey = 'anggota_id';

    protected $fillable = [
        'nama_lengkap', 'username', 'email', 'password_hash',
        'alamat', 'no_telp', 'status_akun', 'tanggal_daftar',
    ];

    protected $hidden = ['password_hash'];

    protected $casts = [
        'tanggal_daftar' => 'date',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'anggota_id', 'anggota_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'anggota_id', 'anggota_id');
    }

    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class, 'anggota_id', 'anggota_id');
    }
}
