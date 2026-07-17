<?php

namespace Database\Seeders;

use App\Models\Bom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bom::insert([
            [
                'product_id' => 1,
                'version' => 1,
                'status' => 'draft',
                'approved_by' => 2,
                'approved_at' => now(),
            ],
            [
                'product_id' => 2,
                'version' => 1,
                'status' => 'approved',
                'approved_by' => 2,
                'approved_at' => now(),
            ],
            [
                'product_id' => 3,
                'version' => 1,
                'status' => 'approved',
                'approved_by' => 2,
                'approved_at' => now(),
            ],
        ]);
    }
}
