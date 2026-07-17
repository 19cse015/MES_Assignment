<?php

namespace Database\Seeders;

use App\Models\BomItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BomItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BomItem::insert([

            ['bom_id' => 4, 'material_id' => 1, 'quantity' => 1],
            ['bom_id' => 4, 'material_id' => 3, 'quantity' => 1],
            ['bom_id' => 4, 'material_id' => 5, 'quantity' => 1],


            ['bom_id' => 5, 'material_id' => 2, 'quantity' => 1],
            ['bom_id' => 5, 'material_id' => 4, 'quantity' => 1],
            ['bom_id' => 5, 'material_id' => 6, 'quantity' => 1],


            ['bom_id' => 6, 'material_id' => 1, 'quantity' => 1],
            ['bom_id' => 6, 'material_id' => 3, 'quantity' => 1],
            ['bom_id' => 6, 'material_id' => 5, 'quantity' => 1],
        ]);
    }
}
