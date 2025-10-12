<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'order_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'address',
        'latitude',
        'longitude',
        'apartment',
        'building_number',
        'landmark',
        'items',
        'subtotal',
        'delivery_fee',
        'total',
        'status',
        'payment_status',
        'noon_order_id',
        'payment_data',
        'notes',
    ];

    protected $casts = [
        'items' => 'array',
        'subtotal' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'total' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
