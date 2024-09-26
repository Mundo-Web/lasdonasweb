<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address_full',
        'address_owner',
        'address_zipcode',
        'address_latitude',
        'address_longitude',
        'address_data',
        'price_amount',
        'is_default',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'address_data' => 'array',
        'address_latitude' => 'decimal:7',
        'address_longitude' => 'decimal:7',
    ];

    /**
     * Get the user that owns the address.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function price()
    {
        return $this->hasOne(PrecioEnvio::class, 'zip_code', 'address_zipcode');
    }
}
