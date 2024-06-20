<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributesValues extends Model
{
    use HasFactory;
    protected $fillable=['attribute_id',
        'valor',
        'descripcion',
        'color',
        'imagen',
        'product_id',
        'visible',
        'status'
    ];

    public function productAttribute()
    {
        return $this->belongsTo(Attributes::class, 'attribute_id');
    }

  
}
