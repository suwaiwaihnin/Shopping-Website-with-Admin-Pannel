<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),

        ]);
        Category::create([
            'name' => 'Shoe',
            'slug' => 'shoe'
        ]);
        Category::create([
            'name' => 'Shirt',
            'slug' => 'shirt'
        ]);
        Category::create([
            'name' => 'Laptop',
            'slug' => 'laptop'
        ]);
        Category::create([
            'name' => 'Phone',
            'slug' => 'phone'
        ]);
        Category::create([
            'name' => 'Hat',
            'slug' => 'hat'
        ]);
        Product::factory(50)->create();
        // \App\Models\User::factory(10)->create();
    }
}
