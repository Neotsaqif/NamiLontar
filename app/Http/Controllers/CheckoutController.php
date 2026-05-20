<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = Auth::user();
        
        $carts = Cart::with('product')->where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        try {
            DB::beginTransaction();

            $subtotal = 0;
            foreach ($carts as $cart) {
                $subtotal += ($cart->product->price * $cart->quantity);
            }

            $shipping = $subtotal > 50 ? 0 : 5.00;
            $tax = $subtotal * 0.1;
            $totalAmount = $subtotal + $shipping + $tax;

            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 'completed', // Hardcode completed for now as per simple flow
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            // Should redirect to a success page or show message
            return redirect('/')->with('success', 'Order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['checkout' => 'Failed to process checkout. Please try again.']);
        }
    }
}
