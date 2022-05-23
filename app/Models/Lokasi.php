<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'tb_lokasi';
    protected $fillable = [
        'id_lokasi','nm_lokasi', 'gambar'
    ];
}
