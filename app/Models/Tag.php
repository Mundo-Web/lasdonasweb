<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','color','slug','type','visible','status'];

    public function articles(): \Illuminate\Database\Eloquent\Relations\MorphToMany
{
    return $this->morphedByMany(Blog::class, 'taggable');
}

public function productos()
{
    return $this->belongsToMany(Products::class, 'tags_xproducts', 'tag_id', 'producto_id');
}

}


