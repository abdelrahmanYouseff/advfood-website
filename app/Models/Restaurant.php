<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo',
        'cover_image',
        'address',
        'phone',
        'email',
        'rating',
        'delivery_time',
        'delivery_fee',
        'minimum_order',
        'is_active',
        'working_hours',
    ];

    protected $casts = [
        'working_hours' => 'array',
        'rating' => 'decimal:1',
        'delivery_fee' => 'decimal:2',
        'minimum_order' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getLogoUrlAttribute(): string
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('images/default-restaurant-logo.png');
    }

    public function getCoverImageUrlAttribute(): string
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : asset('images/default-restaurant-cover.png');
    }
}

