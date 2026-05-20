<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'slug' => 'lontar',
                'name' => 'Nami Lontar Original',
                'price' => 150000,
                'category' => 'Signature Collection',
                'rating' => 5.0,
                'reviews' => 124,
                'description' => 'Our signature Nami Lontar (Papuan Milk Pie) is a delicate balance of creamy, rich egg custard and a buttery, flaky crust. Each tart is hand-crafted using a traditional recipe passed down through generations, ensuring an authentic taste of artisanal excellence.',
                'image' => '/assets/product photo/lontar.jpeg',
                'ingredients' => 'Organic Stone-Ground Flour, Premium Grass-Fed Butter, Organic Free-Range Eggs, Condensed Milk, Sea Salt, Vanilla Bean.',
                'storage' => 'Store in a cool, dry place. For best taste, consume within 3 days. Can be refrigerated for up to 7 days.',
                'artisan_note' => 'We use a slow-bake method at low temperatures to ensure the custard reaches a perfect, silky consistency without any bubbles.',
            ],
            [
                'slug' => 'pastel',
                'name' => 'Pastel Renyah',
                'price' => 85000,
                'category' => 'DAILY FRESH',
                'rating' => 4.5,
                'reviews' => 86,
                'description' => 'Crispy on the outside, savory on the inside. Our Pastel Renyah is filled with a delicious mix of seasoned vegetables and premium protein, wrapped in a perfectly braided crust that stays crunchy for hours.',
                'image' => '/assets/product photo/pastel.jpeg',
                'ingredients' => 'Braided Flour Crust, Seasoned Minced Chicken/Beef, Carrots, Rice Vermicelli, Hard-boiled Eggs, Traditional Spices.',
                'storage' => 'Best consumed fresh. Can be reheated in an air fryer or oven at 180°C for 5 minutes to restore crispiness.',
                'artisan_note' => 'Each braid is hand-folded by our pastry chefs to ensure the filling is perfectly sealed and the texture is consistent.',
            ],
            [
                'slug' => 'kripik',
                'name' => 'Kripik Gurih',
                'price' => 45000,
                'category' => 'SNACK COLLECTION',
                'rating' => 5.0,
                'reviews' => 52,
                'description' => 'Our artisanal chips are thin-sliced and seasoned with a secret blend of herbs and spices. Perfect for sharing or enjoying as a light snack throughout the day.',
                'image' => '/assets/product photo/kripik.jpeg',
                'ingredients' => 'Premium Root Vegetables, Vegetable Oil, Natural Herbs, Sea Salt, Garlic, Traditional Seasoning.',
                'storage' => 'Store in an airtight container at room temperature. Keep away from direct sunlight.',
                'artisan_note' => 'We slice our vegetables extra thin to achieve that perfect snap without any artificial hardening agents.',
            ],
            [
                'slug' => 'lumpia',
                'name' => 'Lumpia Frozen',
                'price' => 120000,
                'category' => 'READY TO COOK',
                'rating' => 4.8,
                'reviews' => 45,
                'description' => 'Enjoy our famous Lumpia at home! These frozen spring rolls are packed with our signature savory filling and ready to fry whenever you crave a hot, crispy treat.',
                'image' => '/assets/product photo/Lumpia Frozen.png',
                'ingredients' => 'Spring Roll Wrappers, Bamboo Shoots, Minced Protein, Traditional Seasoning, Palm Oil.',
                'storage' => 'Keep frozen at -18°C. Do not thaw before frying. Consume within 2 months.',
                'artisan_note' => 'Our wrappers are made in-house to ensure they are thin enough to be crispy but strong enough to hold the generous filling.',
            ],
            [
                'slug' => 'paket-lengkap',
                'name' => 'Paket Lengkap',
                'price' => 450000,
                'category' => 'GIFT BOX',
                'rating' => 5.0,
                'reviews' => 28,
                'description' => 'The ultimate Nami Lontar experience. This gift box includes a curated selection of our best-selling Lontar, Pastel, and Kripik. Perfect for family gatherings or corporate gifts.',
                'image' => '/assets/product photo/full produk.jpeg',
                'ingredients' => 'Includes all ingredients from Lontar, Pastel, and Kripik collections.',
                'storage' => 'Refer to individual product storage instructions.',
                'artisan_note' => 'A comprehensive collection of our finest work, beautifully packaged for your special moments.',
            ],
        ];

        foreach ($products as $prod) {
            $category = \App\Models\Category::where('name', $prod['category'])->first();
            if ($category) {
                $prod['category_id'] = $category->id;
            }
            Product::updateOrCreate(['slug' => $prod['slug']], $prod);
        }
    }
}
