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

            // Check internet connection before making API calls
            $connected = @fsockopen("www.google.com", 80, $errno, $errstr, 2);
            if (!$connected) {
                $connectedMidtrans = @fsockopen("app.sandbox.midtrans.com", 80, $errno, $errstr, 2);
                if (!$connectedMidtrans) {
                    throw new \Exception("No internet connection detected. Please verify your network and try again.");
                } else {
                    fclose($connectedMidtrans);
                }
            } else {
                fclose($connected);
            }

            // Midtrans Configuration
            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => $order->id . '-' . uniqid(),
                    'gross_amount' => (int)$totalAmount,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'shipping_address' => [
                        'first_name' => $user->name,
                        'address' => $user->address,
                        'city' => $user->city,
                        'postal_code' => $user->postal_code,
                        'country_code' => 'IDN'
                    ]
                ],
                'callbacks' => [
                    'finish' => route('cart.index') . '?payment=success',
                ],
            ];


            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $order->snap_token = $snapToken;
            $order->save();

            DB::commit();

            return view('checkout.payment', [
                'order' => $order,
                'snapToken' => $snapToken
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['checkout' => 'Failed to process checkout: ' . $e->getMessage()]);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $orderId = explode('-', $request->order_id)[0];
            $order = Order::find($orderId);

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order->update(['status' => 'paid']);
            } elseif ($request->transaction_status == 'pending') {
                $order->update(['status' => 'pending']);
            } elseif ($request->transaction_status == 'deny' || $request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                $order->update(['status' => 'failed']);
            }

            return response()->json(['message' => 'Callback processed successfully']);
        }

        return response()->json(['message' => 'Invalid signature'], 403);
    }
}


