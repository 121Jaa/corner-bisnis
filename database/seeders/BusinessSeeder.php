<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = [
            // ==================== KOS ====================
            [
                'category_id' => 1,
                'name' => 'Putra',
                'type' => 'Kos Putra A',
                'description' => 'Kos putra dengan kamar luas, full furnished, dan dekat kampus.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567890',
                'image' => 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Full Furnished, Dekat Kampus, CCTV 24 Jam, Wifi Cepat',
            ],
            [
                'category_id' => 1,
                'name' => 'Putra',
                'type' => 'Kos Putra B',
                'description' => 'Kos putra dengan harga terjangkau, fasilitas lengkap, dan parkir luas.',
                'address' => 'Jl. Ngijo Barat, RT 04, Karangploso',
                'phone' => '6281234567891',
                'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Parkir Luas, Harga Terjangkau, Wifi Cepat, Kamar Mandi Luar',
            ],
            [
                'category_id' => 1,
                'name' => 'Putra',
                'type' => 'Kos Putra C',
                'description' => 'Kos putra dengan kamar bersih, ada AC, dan dekat tempat makan.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567891',
                'image' => 'https://images.unsplash.com/photo-1560185008-b033106af5c3?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Ada AC, Dekat Tempat Makan, Parkir Luas, Kamar Bersih',
            ],
            [
                'category_id' => 1,
                'name' => 'Putri',
                'type' => 'Kos Putri A',
                'description' => 'Kos putri yang aman dan nyaman, bebas asap rokok, dan CCTV 24 jam.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567892',
                'image' => 'https://images.unsplash.com/photo-1560185007-cde436f6a4d0?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Bebas Asap Rokok, CCTV 24 Jam, Kamar Mandi Dalam, Wifi Cepat',
            ],
            [
                'category_id' => 1,
                'name' => 'Putri',
                'type' => 'Kos Putri B',
                'description' => 'Kos putri dengan kamar bersih, ada AC, dan dekat tempat makan.',
                'address' => 'Jl. Ngijo Timur, RT 04, Karangploso',
                'phone' => '6281234567893',
                'image' => 'https://images.unsplash.com/photo-1560185008-b033106af5c3?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Ada AC, Dekat Tempat Makan, CCTV 24 Jam, Kamar Bersih',
            ],
            [
                'category_id' => 1,
                'name' => 'Putri',
                'type' => 'Kos Putri C',
                'description' => 'Kos putri dengan harga terjangkau, parkir luas, dan WiFi gratis.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567893',
                'image' => 'https://images.unsplash.com/photo-1560185007-cde436f6a4d0?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Harga Terjangkau, Parkir Luas, Wifi Gratis, Kamar Mandi Dalam',
            ],

            // ==================== KULINER ====================
            [
                'category_id' => 2,
                'name' => 'Warung Makan',
                'type' => 'Warung Bu Rina',
                'description' => 'Makanan rumahan enak dan murah. Spesialis ayam goreng dan sambal bawang.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567894',
                'image' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Ayam Goreng, Sambal Bawang, Nasi Goreng',
            ],
            [
                'category_id' => 2,
                'name' => 'Warung Makan',
                'type' => 'Warung Bu Ida',
                'description' => 'Makanan enak dan murah. Spesialis ikan goreng.',
                'address' => 'RT 04 Ngijo',
                'phone' => '6281234567894',
                'image' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Ikan Goreng, Sambal Ijo, Lele Goreng',
            ],
            [
                'category_id' => 2,
                'name' => 'Cafe',
                'type' => 'Cafe Ngijo',
                'description' => 'Kafe kecil dengan kopi lokal dan pemandangan sawah.',
                'address' => 'Jl. Ngijo Tengah, RT 04, Karangploso',
                'phone' => '6281234567895',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Kopi Susu, Espresso, Roti Bakar',
            ],
            [
                'category_id' => 2,
                'name' => 'Warmindo',
                'type' => 'Warmindo Ngijo',
                'description' => 'Warung indomie legendaris, buka 24 jam, harga bersahabat.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567896',
                'image' => 'https://images.unsplash.com/photo-1552611052-33e04de081de?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Indomie Goreng, Indomie Rebus, Telur Ceplok',
            ],

            // ==================== LAUNDRY ====================
            [
                'category_id' => 3,
                'name' => 'Laundry',
                'type' => 'Laundry Kilat',
                'description' => 'Cuci kilat 1 jam, antar jemput gratis di area RT 04.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567897',
                'image' => 'https://images.unsplash.com/photo-1582735689369-4fe89db7114c?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Cuci Kilat 1 Jam, Antar Jemput, Harga Terjangkau',
            ],
            [
                'category_id' => 3,
                'name' => 'Laundry',
                'type' => 'Laundry Bersih',
                'description' => 'Laundry dengan hasil bersih dan wangi, cocok untuk semua jenis pakaian.',
                'address' => 'Jl. Ngijo Barat, RT 04, Karangploso',
                'phone' => '6281234567898',
                'image' => 'https://images.unsplash.com/photo-1582735689369-4fe89db7114c?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Laundry Semua Jenis, Hasil Bersih, Wangi, Harga Terjangkau',
            ],

            // ==================== JASA ====================
            [
                'category_id' => 4,
                'name' => 'Travel',
                'type' => 'Travel Ngijo',
                'description' => 'Travel antar kota, harga terjangkau, dan sopir berpengalaman.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567897',
                'image' => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Jasa Antar Kota, Harga Terjangkau, Sopir Berpengalaman',
            ],
            [
                'category_id' => 4,
                'name' => 'Tukang',
                'type' => 'Tukang Ngijo',
                'description' => 'Jasa tukang bangunan untuk renovasi rumah, harga negotiable.',
                'address' => 'Jl. Ngijo Selatan, RT 04, Karangploso',
                'phone' => '6281234567898',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Renovasi Rumah, Harga Negotiable, Hasil Rapi',
            ],
            [
                'category_id' => 4,
                'name' => 'Cat',
                'type' => 'Cat Ngijo',
                'description' => 'Jasa pengecatan rumah dan gedung, hasil rapi dan cepat.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567899',
                'image' => 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Pengecatan Rumah, Pengecatan Gedung, Hasil Cepat',
            ],
            [
                'category_id' => 4,
                'name' => 'Sumur',
                'type' => 'Sumur Ngijo',
                'description' => 'Jasa pembuatan sumur bor dan perawatan sumur.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567800',
                'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Pembuatan Sumur, Perawatan Sumur',
            ],

            // ==================== TOKO ====================
            [
                'category_id' => 5,
                'name' => 'Plastik',
                'type' => 'Plastik Ngijo',
                'description' => 'Toko plastik lengkap untuk kebutuhan rumah tangga dan industri.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567801',
                'image' => 'https://images.unsplash.com/photo-1587293852726-70cdb56c2866?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Plastik Rumah Tangga, Plastik Industri',
            ],
            [
                'category_id' => 5,
                'name' => 'Buah',
                'type' => 'Buah Ngijo',
                'description' => 'Toko buah segar setiap hari, melayani partai besar dan kecil.',
                'address' => 'Jl. Ngijo Utara, RT 04, Karangploso',
                'phone' => '6281234567802',
                'image' => 'https://images.unsplash.com/photo-1610832958506-aa56368176cf?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Buah Segar, Partai Besar, Partai Kecil',
            ],
            [
                'category_id' => 5,
                'name' => 'Komputer',
                'type' => 'Komputer Ngijo',
                'description' => 'Toko komputer dan aksesoris, melayani service laptop/PC.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567803',
                'image' => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Jual Komputer, Service Laptop, Aksesoris',
            ],
            [
                'category_id' => 5,
                'name' => 'Kelontong',
                'type' => 'Kelontong Ngijo',
                'description' => 'Toko kelontong kebutuhan sehari-hari, buka dari pagi sampai malam.',
                'address' => 'RT 04 Ngijo, Karangploso, Malang',
                'phone' => '6281234567804',
                'image' => 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?q=80&w=2070&auto=format&fit=crop',
                'facilities' => 'Kebutuhan Sehari-hari, Buka Pagi Sampai Malam',
            ],
        ];

        foreach ($businesses as $business) {
            Business::updateOrCreate(
                ['type' => $business['type']],  // key unik → pakai 'type' karena unik per usaha
                $business
            );
        }
    }
}