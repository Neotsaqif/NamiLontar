<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get mock customers database from session or initialize it.
     */
    private function getMockCustomers(): array
    {
        if (!session()->has('customers_database')) {
            $initialData = [
                1 => [
                    'id' => 1,
                    'name' => 'Alice Johnson',
                    'email' => 'alice@example.com',
                    'phone' => '+1 (555) 019-2834',
                    'address' => '123 Maple Street, San Francisco, CA 94102',
                    'joined_date' => 'Jan 15, 2026',
                    'status' => 'Active',
                    'orders' => [
                        [
                            'id' => 'ORD-1025',
                            'date' => 'Oct 24, 2026',
                            'items_summary' => '3 items (Ceramic Mug, etc.)',
                            'status' => 'processing',
                            'total' => 120.00,
                            'items' => [
                                ['name' => 'Ceramic Mug', 'quantity' => 2, 'price' => 35.00],
                                ['name' => 'Linen Napkins Set', 'quantity' => 1, 'price' => 50.00]
                            ],
                            'shipping_method' => 'Standard Delivery',
                            'payment_method' => 'Credit Card (Visa ending in 4242)'
                        ],
                        [
                            'id' => 'ORD-1020',
                            'date' => 'Sep 12, 2026',
                            'items_summary' => '1 item (Wooden Plate)',
                            'status' => 'delivered',
                            'total' => 45.00,
                            'items' => [
                                ['name' => 'Wooden Plate', 'quantity' => 1, 'price' => 45.00]
                            ],
                            'shipping_method' => 'Standard Delivery',
                            'payment_method' => 'PayPal'
                        ]
                    ]
                ],
                2 => [
                    'id' => 2,
                    'name' => 'Bob Smith',
                    'email' => 'bob@example.com',
                    'phone' => '+1 (555) 043-9821',
                    'address' => '789 Oak Avenue, Austin, TX 78701',
                    'joined_date' => 'Mar 22, 2026',
                    'status' => 'Active',
                    'orders' => [
                        [
                            'id' => 'ORD-1024',
                            'date' => 'Oct 23, 2026',
                            'items_summary' => '1 item (Linen Apron)',
                            'status' => 'delivered',
                            'total' => 45.50,
                            'items' => [
                                ['name' => 'Linen Apron', 'quantity' => 1, 'price' => 45.50]
                            ],
                            'shipping_method' => 'Express Shipping',
                            'payment_method' => 'Apple Pay'
                        ]
                    ]
                ],
                3 => [
                    'id' => 3,
                    'name' => 'Charlie Brown',
                    'email' => 'charlie@example.com',
                    'phone' => '+1 (555) 089-1234',
                    'address' => '456 Pine Road, Seattle, WA 98101',
                    'joined_date' => 'Jun 05, 2026',
                    'status' => 'Active',
                    'orders' => [
                        [
                            'id' => 'ORD-1023',
                            'date' => 'Oct 22, 2026',
                            'items_summary' => '2 items (Wooden Spoon, etc.)',
                            'status' => 'pending',
                            'total' => 89.99,
                            'items' => [
                                ['name' => 'Handcrafted Wooden Spoon', 'quantity' => 1, 'price' => 39.99],
                                ['name' => 'Ceramic Tea Bowl', 'quantity' => 1, 'price' => 50.00]
                            ],
                            'shipping_method' => 'Standard Delivery',
                            'payment_method' => 'Bank Transfer'
                        ]
                    ]
                ]
            ];
            session()->put('customers_database', $initialData);
        }

        return session()->get('customers_database');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function orders()
    {
        // Compile all orders from mock customers
        $orders = [];
        foreach ($this->getMockCustomers() as $customer) {
            foreach ($customer['orders'] as $order) {
                $orders[] = array_merge($order, [
                    'customer_id' => $customer['id'],
                    'customer_name' => $customer['name'],
                    'customer_email' => $customer['email']
                ]);
            }
        }

        // Sort orders by ID descending (or date)
        usort($orders, function ($a, $b) {
            return strcmp($b['id'], $a['id']);
        });

        return view('admin.orders', compact('orders'));
    }

    public function orderShow($id)
    {
        // Search for the order in mock customers
        $foundOrder = null;
        $foundCustomer = null;

        foreach ($this->getMockCustomers() as $customer) {
            foreach ($customer['orders'] as $order) {
                if ($order['id'] === $id || $order['id'] === 'ORD-' . $id || '#' . $order['id'] === $id) {
                    $foundOrder = $order;
                    $foundCustomer = $customer;
                    break 2;
                }
            }
        }

        if (!$foundOrder) {
            abort(404, 'Order not found');
        }

        return view('admin.orders_show', [
            'order' => $foundOrder,
            'customer' => $foundCustomer
        ]);
    }

    /**
     * Update the status of a specific order in the session database.
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,delivered'
        ]);

        $customers = $this->getMockCustomers();
        $updated = false;

        foreach ($customers as $cId => $customer) {
            foreach ($customer['orders'] as $oKey => $order) {
                if ($order['id'] === $id || $order['id'] === 'ORD-' . $id || '#' . $order['id'] === $id) {
                    $customers[$cId]['orders'][$oKey]['status'] = $request->status;
                    $updated = true;
                    break 2;
                }
            }
        }

        if ($updated) {
            session()->put('customers_database', $customers);
            return redirect()->back()->with('success', 'Order status updated successfully!');
        }

        return redirect()->back()->with('error', 'Order not found.');
    }

    public function categories()
    {
        return view('admin.categories');
    }

    public function customers()
    {
        $customers = $this->getMockCustomers();
        return view('admin.customers', compact('customers'));
    }

    public function customerShow($id)
    {
        $customers = $this->getMockCustomers();
        if (!isset($customers[$id])) {
            abort(404, 'Customer not found');
        }

        $customer = $customers[$id];
        return view('admin.customers_show', compact('customer'));
    }

    public function discounts()
    {
        return view('admin.discounts');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
