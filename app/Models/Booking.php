<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'booking_code', 'event_id', 'ticket_type_id',
        'customer_name', 'customer_email', 'customer_phone',
        'quantity', 'total_amount', 'status', 'stripe_payment_id', 'checked_in_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'checked_in_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketType::class);
    }
}
