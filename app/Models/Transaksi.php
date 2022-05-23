<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';
    protected $fillable = [
        'no_order',
        'id_user',
        'email',
        'nohp',
        'alamat',
        'kota',
        'provinsi',
        'kodepos',
        'sub_total',
        'tgl',
        'shipping',
        'total',
        'uniqcode',
        'status',
    ];
}
