<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['subtitle','title2', 'title', 'description', 'botontext1', 'link1', 'botontext2', 'link2', 'url_image', 'name_image', 'url_image2', 'name_image2','status', 'visible'];
}