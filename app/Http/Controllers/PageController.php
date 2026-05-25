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
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_photo' => 'nullable|boolean',
        ]);

        if ($request->has('delete_photo') && $request->delete_photo) {
            if ($user->profile_photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo);
                $user->profile_photo = null;
            }
        }

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo);
            }
            
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->city = $validated['city'];
        $user->postal_code = $validated['postal_code'];
        $user->save();

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
