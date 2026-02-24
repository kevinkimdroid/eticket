<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::where('is_active', true)
            ->where('stock', '>', 0);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $products = $query->orderBy('name')->get();

        return view('shop.index', compact('products'));
    }

    public function show(Product $product): View
    {
        if (!$product->is_active || !$product->isInStock()) {
            abort(404);
        }

        return view('shop.show', compact('product'));
    }
}
