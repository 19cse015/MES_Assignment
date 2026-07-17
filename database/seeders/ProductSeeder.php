<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'category_id' => 1,
                'sku' => 'BL-001',
                'name' => 'ProBook 14',
                'specification' => 'Intel Core i5, 16GB RAM, 512GB SSD, 14-inch FHD Display',
                'status' => 'active',
            ],
            [
                'category_id' => 2,
                'sku' => 'GL-001',
                'name' => 'Gaming X15',
                'specification' => 'Intel Core i7, RTX 4060, 32GB RAM, 1TB SSD, 15.6-inch QHD Display',
                'status' => 'active',
            ],
            [
                'category_id' => 3,
                'sku' => 'UL-001',
                'name' => 'SlimBook Air',
                'specification' => 'Intel Core Ultra 5, 16GB RAM, 512GB SSD, 13.3-inch OLED Display',
                'status' => 'active',
            ],
        ]);
    }
}
