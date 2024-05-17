<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'Wunsun Tarniho',
            'email' => 'wunsun40@gmail.com',
            'password' => 'Wunsun#1060',
            'role' => 'admin',
        ]);

        Category::factory()->create([
            'name' => 'Tutorial',
        ]);

        Category::factory()->create([
            'name' => 'Politic and Geopolitic',
        ]);

        Category::factory()->create([
            'name' => 'Social Economy and Finance',
        ]);

        Category::factory()->create([
            'name' => 'Sains and Technology',
        ]);

        Category::factory()->create([
            'name' => 'Art and Culture',
        ]);

        Category::factory()->create([
            'name' => 'Religion',
        ]);

        Category::factory()->create([
            'name' => 'Computer Science',
        ]);
    }
}
