<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'venue', 'category', 'event_date', 'image', 'is_active', 'is_featured', 'payment_mode'];

    protected $attributes = ['payment_mode' => 'both'];

    public const CATEGORIES = ['concert', 'conference', 'film', 'sports', 'festival', 'comedy', 'other'];

    public const PAYMENT_IMMEDIATE = 'immediate';
    public const PAYMENT_VENUE = 'venue';
    public const PAYMENT_BOTH = 'both';

    protected $casts = [
        'event_date' => 'datetime',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function ticketTypes(): HasMany
    {
        return $this->hasMany(TicketType::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
