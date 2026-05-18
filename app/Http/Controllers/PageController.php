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
}
