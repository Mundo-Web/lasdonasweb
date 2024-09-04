<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Horarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'day',
        'visible',
        'status'
        
    ];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('status', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    public function ordenes($query)
    {
        return $this->hasMany(Ordenes::class, 'horario_envio');
    }
}
