<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'tb_produk';
    protected $fillable = [
        'id_kategori',
        'id_satuan', 
        'nm_produk', 
        'deskripsi', 
        'stok', 
        'foto', 
        'gr',
        'id_lokasi', 
        'harga_modal', 
        'best_seller'
    ];
}
