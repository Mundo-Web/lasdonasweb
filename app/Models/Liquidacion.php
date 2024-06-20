<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'botontext1', 'link1', 'url_image', 'name_image', 'status', 'visible'];
}
