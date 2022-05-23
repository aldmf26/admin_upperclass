<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $table = 'tb_foto';
    protected $fillable = [
        'nm_foto', 'id_produk'
    ];
}
