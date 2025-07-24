<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pesanan',
        'id_user',
        'id_produk',
        'qty',
        'harga_bayar',
        'sub_total',
    ];
}
