<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ⭐ Akun Admin — updateOrCreate
        User::updateOrCreate(
            ['email' => 'admin@cornerbisnis.com'],
            [
                'name' => 'admin',
                'display_name' => 'Administrator RT 04',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        $this->call([
            CategorySeeder::class,
            BusinessSeeder::class,
            TestimonialSeeder::class,
            SiteContentSeeder::class,
        ]);
    }
}