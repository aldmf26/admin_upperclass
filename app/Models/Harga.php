<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;
    protected $table = 'tb_harga';
    protected $fillable = [
        'id_produk', 'id_distribusi', 'harga', 'link'
    ];

}
