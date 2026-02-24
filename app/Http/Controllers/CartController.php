<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if ($product && $product->isInStock()) {
                $subtotal = $product->price * $qty;
                $items[] = (object) [
                    'product' => $product,
                    'qty' => min($qty, $product->stock),
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        return view('shop.cart', compact('items', 'total'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $request->validate(['qty' => 'nullable|integer|min:1|max:99']);

        if (!$product->is_active || !$product->isInStock()) {
            return redirect()->back()->with('error', 'Product not available.');
        }

        $qty = (int) ($request->qty ?? 1);
        $cart = session('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + $qty;
        $cart[$product->id] = min($cart[$product->id], $product->stock);
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Added to cart.');
    }

    public function update(Request $request): RedirectResponse
    {
        $cart = session('cart', []);
        $updates = $request->input('qty', []);

        foreach ($updates as $id => $qty) {
            $id = (int) $id;
            $qty = max(0, min(99, (int) $qty));
            $product = Product::find($id);
            if ($product) {
                if ($qty <= 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id] = min($qty, $product->stock);
                }
            }
        }

        session(['cart' => $cart]);

        return redirect()->route('shop.cart')->with('success', 'Cart updated.');
    }

    public function remove(Product $product): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return redirect()->route('shop.cart')->with('success', 'Item removed.');
    }
}
