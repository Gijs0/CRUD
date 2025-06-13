<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'T-Shirts',
                'description' => 'Comfortable and stylish t-shirts for everyday wear'
            ],
            [
                'name' => 'Jeans',
                'description' => 'Classic and modern jeans for all occasions'
            ],
            [
                'name' => 'Dresses',
                'description' => 'Elegant dresses for special occasions'
            ],
            [
                'name' => 'Sweaters',
                'description' => 'Warm and cozy sweaters for cold weather'
            ],
            [
                'name' => 'Accessories',
                'description' => 'Fashion accessories to complete your look'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}