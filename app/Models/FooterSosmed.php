<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSosmed extends Model
{
    use HasFactory;
    protected $table = 'tb_footer_sosmed';
    protected $fillable = [
        'link'
    ];
}
