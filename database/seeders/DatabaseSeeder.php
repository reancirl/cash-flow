<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Reancirl',
            'email' => 'reancirl@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Category::create([
            'name' => 'Grocery',
            'description' => '',
        ]);

        Category::create([
            'name' => 'Refilling',
            'description' => '',
        ]);

        Category::create([
            'name' => 'Laundry',
            'description' => '',
        ]);

        Category::create([
            'name' => 'Rentals',
            'description' => '',
        ]);
    }
}
