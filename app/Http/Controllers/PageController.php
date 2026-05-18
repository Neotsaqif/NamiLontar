<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        $products = Product::all();
        return view('home', compact('products'));
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
