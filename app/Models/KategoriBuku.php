<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    protected $table = 'kategori_bukus';
    protected $primaryKey = 'kategori_id';
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id', 'kategori_id');
    }
}
