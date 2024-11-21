<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listOfUsers = User::all();

        for ($i = 0; $i < 400; $i++) {
            $user = $listOfUsers->random();
            Blog::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
