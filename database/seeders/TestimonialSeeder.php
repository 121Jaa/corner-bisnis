<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::create([
            'name' => 'Warung Bu Rina',
            'category' => 'Kategori Kuliner',
            'content' => 'Kami sangat terbantu dengan adanya Corner Bisnis. Produk kami jadi lebih dikenal warga sekitar.',
            'image' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=2070&auto=format&fit=crop',
        ]);

        Testimonial::create([
            'name' => 'Cafe Ngijo',
            'category' => 'Kategori Kuliner',
            'content' => 'Tampilan webnya modern dan mudah digunakan. Pelanggan jadi lebih mudah mencari jasa kami.',
            'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=2070&auto=format&fit=crop',
        ]);

        Testimonial::create([
            'name' => 'Kos Putri A',
            'category' => 'Kategori Kos',
            'content' => 'Kos saya selalu penuh sejak terdaftar di sini. Sangat direkomendasikan!',
            'image' => 'https://images.unsplash.com/photo-1560185007-cde436f6a4d0?q=80&w=2070&auto=format&fit=crop',
        ]);
    }
}