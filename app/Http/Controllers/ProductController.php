<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id = null)
    {
        return view('product.show', compact('id'));
    }
}
