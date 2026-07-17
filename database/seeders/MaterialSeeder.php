<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::insert([
            [
                'category_id' => 1,
                'code' => 'CPU-001',
                'name' => 'Intel Core i5-13420H',
                'unit' => 'Piece',
            ],
            [
                'category_id' => 1,
                'code' => 'CPU-002',
                'name' => 'Intel Core i7-13620H',
                'unit' => 'Piece',
            ],

            [
                'category_id' => 2,
                'code' => 'RAM-001',
                'name' => '16GB DDR5 RAM',
                'unit' => 'Piece',
            ],
            [
                'category_id' => 2,
                'code' => 'RAM-002',
                'name' => '32GB DDR5 RAM',
                'unit' => 'Piece',
            ],

            [
                'category_id' => 3,
                'code' => 'SSD-001',
                'name' => '512GB NVMe SSD',
                'unit' => 'Piece',
            ],
            [
                'category_id' => 3,
                'code' => 'SSD-002',
                'name' => '1TB NVMe SSD',
                'unit' => 'Piece',
            ],

            [
                'category_id' => 4,
                'code' => 'LCD-001',
                'name' => '14-inch FHD IPS Display',
                'unit' => 'Piece',
            ],
            [
                'category_id' => 4,
                'code' => 'LCD-002',
                'name' => '15.6-inch QHD IPS Display',
                'unit' => 'Piece',
            ],

            [
                'category_id' => 5,
                'code' => 'MB-001',
                'name' => 'Laptop Motherboard',
                'unit' => 'Piece',
            ],

            [
                'category_id' => 6,
                'code' => 'BAT-001',
                'name' => '65Wh Lithium Battery',
                'unit' => 'Piece',
            ],

            [
                'category_id' => 7,
                'code' => 'FAN-001',
                'name' => 'Cooling Fan',
                'unit' => 'Piece',
            ],

            [
                'category_id' => 8,
                'code' => 'KEY-001',
                'name' => 'Backlit Keyboard',
                'unit' => 'Piece',
            ],

            [
                'category_id' => 9,
                'code' => 'CASE-001',
                'name' => 'Aluminum Laptop Chassis',
                'unit' => 'Piece',
            ],
        ]);
    }
}
