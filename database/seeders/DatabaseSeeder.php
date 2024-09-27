<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'type' => 1,
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'type' => 2,
                'password' => Hash::make('12345678')
            ],
        ]);
    }
}
