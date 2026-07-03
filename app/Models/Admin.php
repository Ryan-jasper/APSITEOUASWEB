<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'nama_admin', 'username', 'email', 'password_hash',
    ];

    protected $hidden = ['password_hash'];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function peminjamanDivalidasi()
    {
        return $this->hasMany(Peminjaman::class, 'admin_id', 'admin_id');
    }
}
