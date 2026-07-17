<?php

namespace Database\Seeders;

use App\Models\MaterialCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialCategory::insert([
            ['name' => 'Processor'],
            ['name' => 'Memory'],
            ['name' => 'Storage'],
            ['name' => 'Display'],
            ['name' => 'Motherboard'],
            ['name' => 'Battery'],
            ['name' => 'Cooling'],
            ['name' => 'Input Device'],
            ['name' => 'Chassis'],
        ]);
    }
}
