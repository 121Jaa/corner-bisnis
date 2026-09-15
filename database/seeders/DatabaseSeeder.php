<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ini yang bikin akun Admin otomatis
        User::create([
            'name' => 'Admin',
            'email' => 'admin@cornerbisnis.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            CategorySeeder::class,
            BusinessSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}