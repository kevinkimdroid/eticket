<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'category', 'image', 'stock', 'points_cost', 'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public const CATEGORIES = [
        'merchandise' => 'Merchandise',
        'apparel' => 'Apparel',
        'accessories' => 'Accessories',
        'collectibles' => 'Collectibles',
    ];

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function canRedeemWithPoints(): bool
    {
        return $this->points_cost !== null && $this->points_cost > 0;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
