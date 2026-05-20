<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // For the view, we just need to render the blade, JS will fetch the data via API
        return view('cart');
    }

    public function getCart()
    {
        $user = Auth::user();
        $carts = Cart::with('product')->where('user_id', $user->id)->get();
        
        $items = $carts->map(function ($cart) {
            return [
                'id' => $cart->product->slug ?? $cart->product_id,
                'name' => $cart->product->name ?? 'Unknown Product',
                'price' => (float) ($cart->product->price ?? 0),
                'image' => $cart->product->image ?? '',
                'quantity' => $cart->quantity
            ];
        });

        return response()->json($items);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        
        $product = Product::where('id', $request->product_id)
            ->orWhere('slug', $request->product_id)
            ->firstOrFail();
            
        $productId = $product->id;

        $cart = Cart::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        
        $product = Product::where('id', $request->product_id)
            ->orWhere('slug', $request->product_id)
            ->firstOrFail();
            
        $cart = Cart::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();
        }

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string'
        ]);

        $user = Auth::user();
        
        $product = Product::where('id', $request->product_id)
            ->orWhere('slug', $request->product_id)
            ->firstOrFail();
        
        Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->delete();

        return response()->json(['success' => true]);
    }
}
