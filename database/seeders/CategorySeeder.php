<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Kos', 'slug' => 'kos', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Kuliner', 'slug' => 'kuliner', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Laundry', 'slug' => 'laundry', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Jasa', 'slug' => 'jasa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Toko', 'slug' => 'toko', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}