<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';
    protected $primaryKey = 'pengembalian_id';
    protected $fillable = [
        'peminjaman_id', 'admin_id', 'tanggal_pengembalian', 'status_pengembalian', 'total_terlambat',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'peminjaman_id');
    }

    public function denda()
    {
        return $this->hasOne(Denda::class, 'pengembalian_id', 'pengembalian_id');
    }
}
