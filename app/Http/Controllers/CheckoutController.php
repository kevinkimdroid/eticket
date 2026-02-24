<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShopOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function show(): View|RedirectResponse
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if ($product && $product->isInStock()) {
                $qty = min($qty, $product->stock);
                $subtotal = $product->price * $qty;
                $items[] = (object) [
                    'product' => $product,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        if (empty($items)) {
            return redirect()->route('shop.cart')->with('error', 'Your cart is empty.');
        }

        return view('shop.checkout', compact('items', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if ($product && $product->isInStock()) {
                $qty = min($qty, $product->stock);
                $subtotal = $product->price * $qty;
                $items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'qty' => $qty,
                    'price' => (float) $product->price,
                ];
                $total += $subtotal;
            }
        }

        if (empty($items)) {
            return redirect()->route('shop.cart')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email',
            'delivery_address' => 'required|string|max:500',
        ]);

        $order = ShopOrder::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'delivery_address' => $request->delivery_address,
            'items' => $items,
            'total' => $total,
            'notes' => $request->notes,
        ]);

        session()->forget('cart');

        return redirect()->route('shop.checkout.success', $order->order_code)
            ->with('success', 'Order received. We\'ll contact you within 24 hours to confirm payment and delivery.');
    }

    public function success(string $orderCode): View
    {
        $order = ShopOrder::where('order_code', $orderCode)->firstOrFail();
        return view('shop.checkout-success', compact('order'));
    }
}
