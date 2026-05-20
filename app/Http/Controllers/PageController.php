<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        $products = Product::all();
        $bestseller = Product::where('slug', 'lontar')->first();
        return view('home', compact('products', 'bestseller'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function cart()
    {
        return view('cart');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function profile()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $orders = \App\Models\Order::where('user_id', $user->id)
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('profile', compact('user', 'orders'));
    }

    public function transactions()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $orders = \App\Models\Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('transactions', compact('user', 'orders'));
    }

    public function orders()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $orders = \App\Models\Order::where('user_id', $user->id)
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('orders', compact('user', 'orders'));
    }

    public function tracking($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $order = \App\Models\Order::where('id', $id)
            ->where('user_id', $user->id)
            ->with('items.product')
            ->firstOrFail();
            
        return view('tracking', compact('order'));
    }
}
