<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'color',
        'icon',
        'status',
    ];

    public function ordenes()
    {
        return $this->hasMany(Ordenes::class, 'status_id');
    }
}
