<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'menu_id',
        'transaksi_id',
        'jumlah',
        'bayar',
        'total',
        'status',
    ];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function transaksi() {
        return $this->belongsTo(Transaksi::class);
    }
}
