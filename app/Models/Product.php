<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'price',
        'category',
        'category_id',
        'rating',
        'reviews',
        'description',
        'image',
        'ingredients',
        'storage',
        'artisan_note',
        'has_size_options',
        'size_options',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'reviews' => 'integer',
        'has_size_options' => 'boolean',
        'size_options' => 'array',
    ];

    /**
     * Get the category that owns the product.
     */
    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Boot function to synchronize relational category_id and category text name.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if ($product->isDirty('category_id') && $product->category_id) {
                $category = Category::find($product->category_id);
                if ($category) {
                    $product->category = $category->name;
                }
            } else if ($product->isDirty('category') && !$product->category_id) {
                // If text category changes, attempt to map to existing category
                $category = Category::where('name', $product->category)->first();
                if ($category) {
                    $product->category_id = $category->id;
                }
            }
        });
    }
}
