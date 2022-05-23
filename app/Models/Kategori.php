<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'tb_kategori';
    protected $fillable = [
        'id_kategori','nm_kategori', 'id_lokasi'
    ];
}
