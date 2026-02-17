<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'category_id',
        'name',
        'name_ar',
        'description',
        'description_ar',
        'price',
        'image',
        'is_available',
        'is_featured',
        'sort_order',
        'options',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'options' => 'array',
    ];

    protected $appends = ['image_url', 'formatted_price'];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/default-product.png');
        }

        // Check if the image path starts with 'menu/' (public directory)
        if (str_starts_with($this->image, 'menu/')) {
            return asset($this->image);
        }

        // Otherwise, use storage path
        return asset('storage/' . $this->image);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2) . ' ريال';
    }
}

