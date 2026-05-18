<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Get the products for the category.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Boot function to cascade category name changes and deletions to associated products.
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($category) {
            if ($category->isDirty('name')) {
                $category->products()->update(['category' => $category->name]);
            }
        });

        static::deleting(function ($category) {
            $category->products()->update([
                'category_id' => null,
                'category' => null
            ]);
        });
    }
}
