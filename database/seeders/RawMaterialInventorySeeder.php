<?php

namespace Database\Seeders;

use App\Models\RawMaterialInventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawMaterialInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RawMaterialInventory::insert([
            [
                'material_id' => 1, // Intel Core i5
                'available_quantity' => 100,
                'reserved_quantity' => 0,
            ],
            [
                'material_id' => 3, // 16GB RAM
                'available_quantity' => 200,
                'reserved_quantity' => 0,
            ],
            [
                'material_id' => 5, // 512GB SSD
                'available_quantity' => 150,
                'reserved_quantity' => 0,
            ],
            [
                'material_id' => 7, // 14" Display
                'available_quantity' => 120,
                'reserved_quantity' => 0,
            ],
            [
                'material_id' => 9, // Motherboard
                'available_quantity' => 100,
                'reserved_quantity' => 0,
            ],
            [
                'material_id' => 10, // Battery
                'available_quantity' => 100,
                'reserved_quantity' => 0,
            ],
            [
                'material_id' => 11, // Cooling Fan
                'available_quantity' => 100,
                'reserved_quantity' => 0,
            ],
            [
                'material_id' => 12, // Keyboard
                'available_quantity' => 100,
                'reserved_quantity' => 0,
            ],
            [
                'material_id' => 13, // Chassis
                'available_quantity' => 100,
                'reserved_quantity' => 0,
            ],
        ]);
    }
}
