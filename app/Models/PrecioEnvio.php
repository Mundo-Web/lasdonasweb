<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioEnvio extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'direcction', 'zip_code', 'price', 'visible', 'status'];
}
