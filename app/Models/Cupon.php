<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'cliente_id',
     'fecha_asignacion', 'usado', 'monto'];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
}
