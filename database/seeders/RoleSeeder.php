<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([

            ['name'=>'system_admin'],

            ['name'=>'production_manager'],

            ['name'=>'warehouse_manager'],

            ['name'=>'machine_operator'],

            ['name'=>'quality_inspector'],

        ]);
    }
}
