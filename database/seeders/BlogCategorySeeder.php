<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = Blog::all();
        $categories = Category::all();

        foreach ($blogs as $blog) {
            // Select random categories for the blog
            $randomCategories = $categories->random(rand(1, 10))->pluck('id');

            // Prepare the data with timestamps
            $pivotData = $randomCategories->mapWithKeys(function ($categoryId) {
                return [
                    $categoryId => [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ];
            })->toArray();

            // Attach with timestamps
            $blog->categories()->syncWithoutDetaching($pivotData);
        }
    }
}
