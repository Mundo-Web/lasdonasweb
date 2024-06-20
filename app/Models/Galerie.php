<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galerie extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'valor',
        'descripcion',
        'color',
        'imagen'
    ];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
