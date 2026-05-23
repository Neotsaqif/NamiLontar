<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'cart_data' => 'required|json'
        ]);

        $user = Auth::user();
        
        // Enforce address requirement
        if (empty($user->address) || empty($user->city) || empty($user->postal_code)) {
            return redirect()->route('profile')->with('warning', 'Please complete your shipping address before checking out.');
        }

        $cartItems = json_decode($request->input('cart_data'), true);

        if (empty($cartItems)) {
            return redirect()->back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        try {
            DB::beginTransaction();

            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += ($item['price'] * $item['quantity']);
            }

            $shipping = $subtotal > 500000 ? 0 : 50000;
            $tax = $subtotal * 0.1;
            $totalAmount = $subtotal + $shipping + $tax;

            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'address' => $user->address,
                'city' => $user->city,
                'postal_code' => $user->postal_code,
            ]);

            foreach ($cartItems as $item) {
                // Find product by slug or id to get the correct product_id for DB
                $product = \App\Models\Product::where('slug', $item['id'])
                    ->orWhere('id', $item['id'])
                    ->first();

                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                    ]);
                }
            }

            DB::commit();

            // Store success message and a flag to clear localStorage on next page load
            return redirect('/')->with('success', 'Order has been placed successfully!')
                               ->with('clear_cart', true);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['checkout' => 'Failed to process checkout. Please try again.']);
        }
    }
}
