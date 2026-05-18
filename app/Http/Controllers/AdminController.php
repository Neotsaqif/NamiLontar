<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function orders()
    {
        return view('admin.orders');
    }

    public function categories()
    {
        return view('admin.categories');
    }

    public function customers()
    {
        return view('admin.customers');
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
