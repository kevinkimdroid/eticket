# eTicket KE – Event Ticketing System

A complete event ticketing system for Kenya with M-Pesa, card payments, QR tickets, and admin management.

## Features

### Public
- Browse upcoming events
- Book tickets with customer details
- **Pay via M-Pesa** (Lipa Na M-Pesa), **Card** (Stripe), or **Cash at venue**
- Receive ticket with unique code, QR code, and shareable link
- Email confirmation with ticket link

### Admin
- Dashboard with revenue, bookings, check-ins
- Create and manage events and ticket types
- View all bookings
- **Export bookings to CSV**
- **Scan/lookup** tickets by code for check-in

### Technical
- Kenyan Shillings (KSh) currency
- Africa/Nairobi timezone
- M-Pesa Daraja API integration
- Stripe Checkout for cards
- Email ticket confirmations
- Custom 404/500 error pages

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### Environment

```env
APP_NAME="eTicket KE"
APP_URL=http://localhost:8000
APP_TIMEZONE=Africa/Nairobi
APP_CURRENCY=KES
APP_CURRENCY_SYMBOL=KSh

# M-Pesa (Safaricom Daraja API)
MPESA_CONSUMER_KEY=
MPESA_CONSUMER_SECRET=
MPESA_SHORTCODE=
MPESA_PASSKEY=
MPESA_ENV=sandbox

# Stripe
STRIPE_KEY=
STRIPE_SECRET=
```

### M-Pesa Callback

For M-Pesa, Safaricom must call your callback URL. Use a tunnel (e.g. ngrok) in development:

```
https://your-domain.com/mpesa/callback
```

Add this URL in your Daraja app settings.

## Default Admin

- **Email:** admin@eticket.com  
- **Password:** password  

## Run

```bash
php artisan serve
```

Open http://localhost:8000
