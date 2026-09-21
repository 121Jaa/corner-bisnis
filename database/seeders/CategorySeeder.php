<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Kos', 'slug' => 'kos'],
            ['id' => 2, 'name' => 'Kuliner', 'slug' => 'kuliner'],
            ['id' => 3, 'name' => 'Laundry', 'slug' => 'laundry'],
            ['id' => 4, 'name' => 'Jasa', 'slug' => 'jasa'],
            ['id' => 5, 'name' => 'Toko', 'slug' => 'toko'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['id' => $category['id']],
                [
                    'name' => $category['name'],
                    'slug' => $category['slug'],
                ]
            );
        }
    }
}