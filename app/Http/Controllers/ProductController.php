<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(\Illuminate\Http\Request $request, $slug = null)
    {
        if (empty($slug)) {
            $slug = $request->query('id');
        }

        if (empty($slug)) {
            $slug = 'lontar';
        }

        $product = Product::where('slug', $slug)->firstOrFail();
        $pairings = Product::where('id', '!=', $product->id)->take(2)->get();

        return view('product.show', compact('product', 'pairings'));
    }
}
