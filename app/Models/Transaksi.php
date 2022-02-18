<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'nama',
        'meja',
        'total',
        'bayar',
        'status',
    ];

    public function pesanan() {
        return $this->hasMany(Pesanan::class);
    }

    public function meja() {
        return $this->belongsTo(Meja::class);
    }
}
