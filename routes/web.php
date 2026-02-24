<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TicketTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('events.index'));

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/calendar', [EventController::class, 'calendar'])->name('events.calendar');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event}/book', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/payment', [BookingController::class, 'payment'])->name('bookings.payment');
Route::post('/bookings/{booking}/pay', [BookingController::class, 'pay'])->name('bookings.pay');
Route::get('/bookings/{booking}/stripe', [StripeController::class, 'checkout'])->name('bookings.stripe');
Route::get('/bookings/{booking}/stripe/success', [StripeController::class, 'success'])->name('bookings.stripe.success');
Route::get('/bookings/{booking}/mpesa', function (App\Models\Booking $booking) {
    if ($booking->status !== 'pending') return redirect()->route('tickets.show', $booking->booking_code);
    return view('bookings.mpesa', compact('booking'));
})->name('bookings.mpesa');
Route::post('/bookings/{booking}/mpesa', [\App\Http\Controllers\MpesaController::class, 'initiate'])->name('mpesa.initiate');
Route::post('/mpesa/callback', [\App\Http\Controllers\MpesaController::class, 'callback'])->name('mpesa.callback')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/ticket/{code}', [TicketController::class, 'show'])->name('tickets.show');
Route::get('/ticket/{code}/qr', [TicketController::class, 'qr'])->name('tickets.qr');

Route::post('/newsletter', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/shop', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [\App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');
Route::post('/cart/{product}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('shop.cart');
Route::post('/cart', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'show'])->name('shop.checkout');
Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('shop.checkout.store');
Route::get('/checkout/success/{orderCode}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('shop.checkout.success');

Route::get('/about', [\App\Http\Controllers\StaticPageController::class, 'about'])->name('about');
Route::get('/fans', [\App\Http\Controllers\StaticPageController::class, 'fans'])->name('fans');
Route::get('/contact', [\App\Http\Controllers\StaticPageController::class, 'contact'])->name('contact');
Route::get('/terms', [\App\Http\Controllers\StaticPageController::class, 'terms'])->name('terms');
Route::get('/privacy', [\App\Http\Controllers\StaticPageController::class, 'privacy'])->name('privacy');
Route::get('/faq', [\App\Http\Controllers\StaticPageController::class, 'faq'])->name('faq');

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::redirect('admin/login', '/login', 301);
Route::redirect('organizers/login', '/login', 301);

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', AdminEventController::class)->except(['show']);
        Route::post('events/{event}/ticket-types', [TicketTypeController::class, 'store'])->name('ticket-types.store');
        Route::delete('ticket-types/{ticketType}', [TicketTypeController::class, 'destroy'])->name('ticket-types.destroy');
        Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/export', [AdminBookingController::class, 'export'])->name('bookings.export');
        Route::post('bookings/lookup', [AdminBookingController::class, 'lookup'])->name('bookings.lookup');
        Route::post('bookings/{booking}/check-in', [AdminBookingController::class, 'checkIn'])->name('bookings.check-in');
        Route::get('scan', [AdminBookingController::class, 'scan'])->name('scan');
        Route::middleware('admin.only')->group(function () {
            Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
            Route::get('users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
            Route::post('users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
            Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
            Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        });
});
