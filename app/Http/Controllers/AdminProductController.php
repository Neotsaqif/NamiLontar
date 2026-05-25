<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $products = Product::where('name', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->get();
        } else {
            $products = Product::all();
        }

        return view('admin.products.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'ingredients' => 'nullable|string',
            'storage' => 'nullable|string',
            'artisan_note' => 'nullable|string',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->input('name')) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('product-photos/main'), $filename);
            $data['image'] = '/product-photos/main/' . $filename;
        }

        // Set default rating & reviews for demonstration
        $data['rating'] = 5.0;
        $data['reviews'] = rand(5, 50);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'ingredients' => 'nullable|string',
            'storage' => 'nullable|string',
            'artisan_note' => 'nullable|string',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Move old file to trash if exists
            if ($product->image && str_starts_with($product->image, '/product-photos/main/')) {
                $oldPath = public_path(substr($product->image, 1));
                if (file_exists($oldPath)) {
                    $trashFilename = 'trashed_' . time() . '_' . basename($oldPath);
                    @rename($oldPath, public_path('product-photos/trash/' . $trashFilename));
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->input('name')) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('product-photos/main'), $filename);
            $data['image'] = '/product-photos/main/' . $filename;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Move image file to trash if exists
        if ($product->image && str_starts_with($product->image, '/product-photos/main/')) {
            $filePath = public_path(substr($product->image, 1));
            if (file_exists($filePath)) {
                $trashFilename = 'trashed_' . time() . '_' . basename($filePath);
                @rename($filePath, public_path('product-photos/trash/' . $trashFilename));
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
