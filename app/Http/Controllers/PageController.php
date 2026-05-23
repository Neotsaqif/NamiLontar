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

    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
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

    public function completeOrder(\Illuminate\Http\Request $request, $id)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $order = \App\Models\Order::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if ($order->status === 'delivery') {
            $order->update(['status' => 'completed']);
            return redirect()->back()->with('success', 'Order marked as completed. Thank you!');
        }

        return redirect()->back()->with('error', 'Unable to complete order at this stage.');
    }
}
