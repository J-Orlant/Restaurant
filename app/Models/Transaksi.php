<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'pesanan_id',
        'total',
        'bayar',
    ];

    public function pesanan() {
        return $this->belongsTo(Pesanan::class);
    }
}
