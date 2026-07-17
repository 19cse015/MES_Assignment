<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::insert([
            [
                'name' => 'Business Laptop',
                'description' => 'Laptops designed for office and enterprise users.'
            ],
            [
                'name' => 'Gaming Laptop',
                'description' => 'High-performance laptops for gaming.'
            ],
            [
                'name' => 'Ultrabook',
                'description' => 'Thin and lightweight premium laptops.'
            ],
        ]);
    }
}
