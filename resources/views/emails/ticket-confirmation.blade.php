<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ticket</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #334155; max-width: 480px; margin: 0 auto; padding: 20px;">
    <h1 style="color: #4f46e5; margin-bottom: 8px;">{{ $booking->event->title }}</h1>
    <p style="color: #64748b; margin-bottom: 24px;">{{ $booking->event->venue }} · {{ $booking->event->event_date->format('l, F j, Y \a\t g:i A') }}</p>
    <p>Hi {{ $booking->customer_name }},</p>
    <p>Your ticket is confirmed. Here are the details:</p>
    <div style="background: #f1f5f9; padding: 16px; border-radius: 8px; margin: 20px 0;">
        <p style="margin: 0;"><strong>Booking Code:</strong> {{ $booking->booking_code }}</p>
        <p style="margin: 8px 0 0 0;"><strong>Ticket:</strong> {{ $booking->ticketType->name }} × {{ $booking->quantity }}</p>
    </div>
    <p>
        <a href="{{ route('tickets.show', $booking->booking_code) }}" style="display: inline-block; background: #4f46e5; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px;">View Your Ticket</a>
    </p>
    <p style="color: #64748b; font-size: 14px; margin-top: 24px;">Present this ticket at the entrance. You can also show the QR code from the link above.</p>
</body>
</html>
