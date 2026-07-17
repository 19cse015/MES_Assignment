<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([

            [
                'name' => 'System Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
            ],
            [
                'name' => 'Production Manager',
                'email' => 'pm@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
            [
                'name' => 'Warehouse Manager',
                'email' => 'wm@example.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
            ],
            [
                'name' => 'Machine Operator',
                'email' => 'operator@example.com',
                'password' => Hash::make('password'),
                'role_id' => 4,
            ],
            [
                'name' => 'Quality Inspector',
                'email' => 'qa@example.com',
                'password' => Hash::make('password'),
                'role_id' => 5,
            ],

        ]);
    }
}
