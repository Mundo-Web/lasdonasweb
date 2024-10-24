<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable=['category_id', 'name', 'description' ,'state'];


    // 
    public function category()
    {
        return Category::find($this->category_id);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
