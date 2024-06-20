<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAttribute extends Model
{
    use HasFactory;
    protected $table = 'type_atributtes';
    protected $fillable = ['name'];
    
    public function attributes()
    {
        return $this->hasMany(Attributes::class, 'type_atributte_id');
    }
}
