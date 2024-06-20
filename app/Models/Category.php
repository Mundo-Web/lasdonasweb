<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','slug', 'description', 'url_image', 'name_image','destacar', 'visible', 'state'];

    // public function subcategories()
    // {
    //     return $this->hasMany(Subcategory::class, 'category_id');
    // }

    // public function blogs()
    // {
    //     return $this->hasMany(Blog::class, 'category_id');
    // }

    public function productos()
    {
        return $this->hasMany(Products::class);
    }
}
