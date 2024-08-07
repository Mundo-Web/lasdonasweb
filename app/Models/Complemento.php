<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complemento extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'url_image',
        'name_image',
        'destacar',
        'visible',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'complemento_id');
    }

    public function getMinPriceAttribute()
    {
        
        return $this->products()->min('preciofiltro');
    }
}
