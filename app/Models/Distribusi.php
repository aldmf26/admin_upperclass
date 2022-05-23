<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    use HasFactory;
    protected $table = 'tb_distribusi';
    protected $fillable = [
        'id_kategori','nm_distribusi'
    ];
}
