<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'type_imagen', 'caratula', 'color_id', 'name_imagen'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function imagenProducto(){
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(AttributesValues::class, 'color_id');
    }
}
