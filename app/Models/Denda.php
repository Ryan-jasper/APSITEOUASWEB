<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'dendas';
    protected $primaryKey = 'denda_id';
    protected $fillable = [
        'pengembalian_id', 'jumlah_hari_terlambat', 'tarif_per_hari', 'total_denda', 'status_bayar',
    ];

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class, 'pengembalian_id', 'pengembalian_id');
    }
}
