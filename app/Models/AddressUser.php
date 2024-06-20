<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressUser extends Model
{
    use HasFactory;

    protected $fillable =  [
        'departamento_id',
        'provincia_id',
        'distrito_id',
        'dir_av_calle',
        'dir_numero',
        'dir_bloq_lote',
        'imagen',
        'user_id'
    ];
}
