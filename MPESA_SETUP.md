# M-Pesa Payment Setup

This guide explains how to configure M-Pesa (Lipa Na M-Pesa) for eTicket KE.

## 1. Register on Safaricom Daraja

1. Go to [https://developer.safaricom.co.ke](https://developer.safaricom.co.ke)
2. Create an account and log in
3. Go to **My Apps** → **Add a new app**
4. Create an app (e.g. "eTicket KE")
5. You'll get **Consumer Key** and **Consumer Secret**

## 2. Get Sandbox Credentials (Testing)

For sandbox testing:

- **Consumer Key** & **Consumer Secret**: From your app in Daraja portal
- **Shortcode**: Use `174379` (Safaricom sandbox test paybill)
- **Passkey**: Get from Daraja under **Lipa Na M-Pesa Online** → **Sandbox Test Credentials**

## 3. Add to .env

```env
MPESA_CONSUMER_KEY=your_consumer_key_here
MPESA_CONSUMER_SECRET=your_consumer_secret_here
MPESA_SHORTCODE=174379
MPESA_PASSKEY=your_passkey_here
MPESA_ENV=sandbox
```

## 4. Callback URL (Important)

Safaricom must reach your callback URL to confirm payments. **Localhost does not work** — Safaricom's servers cannot reach your computer.

### Option A: Local development with ngrok

1. Install [ngrok](https://ngrok.com): `ngrok http 8000`
2. Copy the HTTPS URL (e.g. `https://abc123.ngrok-free.app`)
3. Add to .env:

```env
MPESA_CALLBACK_URL=https://abc123.ngrok-free.app/mpesa/callback
APP_URL=https://abc123.ngrok-free.app
```

4. In Daraja portal, add the callback URL to your app's Lipa Na M-Pesa settings
5. Access your site via the ngrok URL when testing M-Pesa

### Option B: Production (deployed site)

When deployed (e.g. https://eticket.co.ke):

- `APP_URL` should be your real domain
- Callback will be `https://eticket.co.ke/mpesa/callback`
- Add this URL in Daraja under your app's Lipa Na M-Pesa configuration

## 5. Production Credentials

For live payments:

1. Complete Safaricom's Lipa Na M-Pesa onboarding
2. Get your **production shortcode** (Paybill/Till number)
3. Get your **production passkey**
4. Update .env:

```env
MPESA_ENV=production
MPESA_SHORTCODE=your_paybill_number
MPESA_PASSKEY=your_production_passkey
```

## 6. Verify

1. Run `php artisan config:clear`
2. Book a ticket and choose M-Pesa
3. Enter phone number (format: 254712345678 or 0712345678)
4. You should receive an STK push on your phone (sandbox uses test numbers)

## Sandbox Test Numbers

Safaricom sandbox uses specific test numbers. Check the Daraja documentation for current sandbox test phone numbers that receive STK push.
