<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'HEVV1',
            'email' => 'hevv1@example.com',
        ]);

        User::factory(100)->create();

        $this->call([
            CategorySeeder::class,
            BlogSeeder::class,
            BlogCategorySeeder::class
        ]);
    }
}

