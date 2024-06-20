<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;
    protected $fillable =  ['titulo',
    'slug',
    'type_atributte_id',
    'imagen',
    'descripcion',
    'valores',
    'color',
    'visible',
    'status'];

    public function attributeValues() 
    {
        return $this->hasMany(AttributesValues::class, 'attribute_id');
    }

    public function typeAttribute()
    {
        return $this->belongsTo(TypeAttribute::class, 'type_atributte_id');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class, 'attribute_product_values', 'attribute_id', 'product_id')
            ->withPivot('attribute_value_id');
            
    }
   
    
}
