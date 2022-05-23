<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wa extends Model
{
    use HasFactory;
    protected $table = 'wa';
    protected $fillable = 'nomor';
}
