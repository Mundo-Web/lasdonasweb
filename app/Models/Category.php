<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','slug', 'description', 'url_image', 'name_image','destacar', 'visible', 'state', 'start_date_campaing', 
    'end_date_campaing', 'is_active_campaing'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id')->where('status', true);
    }

    // public function blogs()
    // {
    //     return $this->hasMany(Blog::class, 'category_id');
    // }

    public function productos()
    {
        return $this->hasMany(Products::class, 'categoria_id');
    }
}
