<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Signature Collection',
                'description' => 'Our highly-coveted traditional premium lontar pies.',
            ],
            [
                'name' => 'DAILY FRESH',
                'description' => 'Freshly baked buns and artisan daily goods.',
            ],
            [
                'name' => 'SNACK COLLECTION',
                'description' => 'Crispy local pastries and sweet snack bites.',
            ],
            [
                'name' => 'READY TO COOK',
                'description' => 'Packaged ready-to-bake pastries for your home oven.',
            ],
            [
                'name' => 'GIFT BOX',
                'description' => 'Elegant packaging boxes to share love with others.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['name' => $cat['name']],
                [
                    'slug' => Str::slug($cat['name']),
                    'description' => $cat['description']
                ]
            );
        }
    }
}
