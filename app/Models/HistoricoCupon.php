<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoCupon extends Model
{
    use HasFactory;

    protected $table = 'historico_cupones';

    protected $fillable = [
        'cupones_id',
        'user_id',
        'fecha_canje',
        'usado', 
        'orden_id'
    ];

    public function cupon()
    {
        return $this->belongsTo(Cupon::class, 'cupones_id');
    }
}
