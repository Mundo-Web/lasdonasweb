<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    use HasFactory;
    protected $fillable = [

        'codigo',
        'fecha_caducidad',
        'monto',
        'porcentaje',
        'visible',
        'status'
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function historico()
    {
        return $this->hasMany(HistoricoCupon::class, 'cupones_id');
    }
}
