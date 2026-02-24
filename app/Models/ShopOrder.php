<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShopOrder extends Model
{
    protected $fillable = [
        'order_code', 'customer_name', 'customer_phone', 'customer_email',
        'delivery_address', 'items', 'total', 'status', 'notes',
    ];

    protected $casts = [
        'items' => 'array',
        'total' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (ShopOrder $order) {
            if (empty($order->order_code)) {
                $order->order_code = strtoupper(Str::random(8));
            }
        });
    }
}
