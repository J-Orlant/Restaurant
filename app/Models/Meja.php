<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $table = 'meja';

    protected $fillable = [
        'id',
        'status',
    ];

    public function transaksi() {
        return $this->belongsTo(Transaksi::class);
    }
}
