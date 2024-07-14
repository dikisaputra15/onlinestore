<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'tgl_pemesanan',
        'nama_penerima',
        'no_hp',
        'alamat',
        'total_bayar',
        'status',
        'keterangan',
    ];
}
