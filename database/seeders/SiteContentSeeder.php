<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        // ===== HERO =====
        SiteContent::set('hero_slides', json_encode([
            'images/1.avif',
            'images/download.jfif',
            'images/anjay.jpg',
        ]), 'json');
        SiteContent::set('hero_badge', 'RT 04 Ngijo');
        SiteContent::set('hero_title', 'Corner Bisnis<br>RT 04 Ngijo');
        SiteContent::set('hero_subtitle', 'Temukan berbagai usaha dan jasa yang dijalankan oleh warga RT 04 Ngijo.');

        // ===== NAVBAR LOGO =====
        SiteContent::set('navbar_logo_type', 'text');        // 'text' atau 'image'
        SiteContent::set('navbar_logo_text', 'RT 04');
        SiteContent::set('navbar_logo_image', '', 'image');  // path gambar

        // ===== TENTANG =====
        SiteContent::set('about_label', 'Design Philosophy');
        SiteContent::set('about_title', 'Our Story');
        SiteContent::set('about_subtitle', 'Contemporary Design. Crafted by Culture.');
        SiteContent::set('about_desc_1', 'Setiap ruang di Corner Bisnis terinspirasi dari kerajinan tangan dan semangat gotong royong warga RT 04.');
        SiteContent::set('about_desc_2', 'Dinding maroon yang hangat, sentuhan kuning marigold, dan aksen kayu kenari berpadu menciptakan suasana yang terasa modern.');
        SiteContent::set('about_image', 'images/2.avif', 'image');

        // ===== USAHA SECTION =====
        SiteContent::set('business_label', 'Explore');
        SiteContent::set('business_title', 'Usaha Warga RT 04');
        SiteContent::set('business_subtitle', 'Jelajahi berbagai produk dan jasa yang dibuat langsung oleh warga sekitar.');
        SiteContent::set('business_view_detail', 'Lihat Detail →');
        SiteContent::set('business_view_all_button', 'Lihat Semua Usaha');
        SiteContent::set('business_empty', 'Belum ada usaha yang terdaftar.');

        // ===== TESTIMONI =====
        SiteContent::set('testimonial_label', 'Testimonials');
        SiteContent::set('testimonial_title', 'Apa Kata Mereka?');
        SiteContent::set('testimonial_subtitle', 'Pilih usaha lain yang mungkin cocok untuk kamu.');
        SiteContent::set('testimonial_empty', 'Belum ada testimoni.');

        // ===== CTA =====
        SiteContent::set('cta_title', 'Punya Usaha di RT 04?');
        SiteContent::set('cta_desc', 'Daftarkan usaha kamu sekarang dan biar lebih banyak warga yang tahu!');
        SiteContent::set('cta_button', 'Daftar Sekarang');

        // ===== STATISTIK =====
        SiteContent::set('stat_access', '24/7');
        SiteContent::set('stat_helped', '100%');
        SiteContent::set('stat_business_label', 'Usaha Terdaftar');
        SiteContent::set('stat_category_label', 'Kategori Usaha');
        SiteContent::set('stat_access_label', 'Akses Online');
        SiteContent::set('stat_helped_label', 'Warga Terbantu');

        // ===== FOOTER =====
        SiteContent::set('footer_title', 'RT 04 NGIJO');
        SiteContent::set('footer_desc', 'Corner Bisnis RT 04 Ngijo adalah platform untuk memamerkan dan mempromosikan berbagai usaha kecil dan menengah yang dikelola oleh warga sekitar.');
        SiteContent::set('footer_nav_title', 'Navigasi');
        SiteContent::set('footer_contact_title', 'Kontak');
        SiteContent::set('footer_copyright', 'Corner Bisnis RT 04 Ngijo. Semua Hak Dilindungi.');

        // ===== FOOTER NAV LINKS =====
        SiteContent::set('footer_nav_home', 'Halaman Utama');
        SiteContent::set('footer_nav_business', 'Semua Usaha');
        SiteContent::set('footer_nav_register', 'Daftar Usaha');
        SiteContent::set('footer_nav_about', 'Tentang Kami');

        // ===== KONTAK =====
        SiteContent::set('contact_address', 'RT 04 Ngijo, Karangploso, Malang');
        SiteContent::set('contact_phone', '+62 812-3456-7890');
        SiteContent::set('contact_email', 'cornerbisnis@gmail.com');
        SiteContent::set('contact_whatsapp', '6281234567890');
    }
}
