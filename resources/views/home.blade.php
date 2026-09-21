<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\SiteContent::get('footer_title', 'Corner Bisnis RT 04 Ngijo') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .duration-1500 {
            transition-duration: 1500ms;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes kenBurns {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }

        .animate-fade-in-down {
            animation: fadeInDown 1s ease-out forwards;
        }

        .delay-200 {
            animation-delay: 200ms;
            opacity: 0;
        }

        .delay-500 {
            animation-delay: 500ms;
            opacity: 0;
        }

        .hero-slide {
            transition: opacity 1500ms ease-in-out;
        }

        .hero-slide.active {
            animation: kenBurns 8s ease-in-out infinite alternate;
        }

        .hero-dot {
            cursor: pointer;
            border: none;
            outline: none;
        }

        .hero-dot:hover {
            background-color: white !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    @include('partials.navbar')

    {{-- ==================== HERO ==================== --}}
    <section class="relative flex h-screen w-full items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            @php
            $heroImages = \App\Models\SiteContent::getJson('hero_slides', ['images/1.avif']);
            @endphp

            @foreach ($heroImages as $index => $image)
            <div class="hero-slide absolute inset-0 bg-cover bg-center {{ $index === 0 ? 'opacity-100 active' : 'opacity-0' }}"
                style="background-image: url('{{ asset($image) }}');"></div>
            @endforeach

            <div class="absolute inset-0 bg-black/50 z-10"></div>
        </div>

        <div class="relative z-20 mx-auto max-w-4xl px-6 pt-24 pb-10 text-center text-white">
            <p class="text-sm font-semibold uppercase tracking-wider text-gray-300 animate-fade-in-down">
                {{ \App\Models\SiteContent::get('hero_badge', 'RT 04 Ngijo') }}
            </p>
            <h1 class="font-serif-display mt-3 text-4xl font-bold tracking-tight md:text-6xl animate-fade-in-up">
                {!! \App\Models\SiteContent::get('hero_title', 'Corner Bisnis<br>RT 04 Ngijo') !!}
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-200 animate-fade-in-up delay-200">
                {{ \App\Models\SiteContent::get('hero_subtitle', 'Temukan berbagai usaha dan jasa yang dijalankan oleh warga RT 04 Ngijo.') }}
            </p>
        </div>

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            @foreach ($heroImages as $index => $image)
            <button class="hero-dot w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white w-8' : 'bg-white/50' }}"
                onclick="goToSlide({{ $index }})" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <div class="absolute bottom-8 right-8 z-20 hidden md:block animate-bounce">
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    {{-- ==================== TENTANG ==================== --}}
    <section class="relative bg-[#4a1e2b] text-white py-24">
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 20px 20px;">
        </div>
        <div class="relative z-10 mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-16 lg:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-yellow-500">
                        {{ \App\Models\SiteContent::get('about_label', 'Design Philosophy') }}
                    </p>
                    <h2 class="font-serif-display mt-6 text-5xl font-bold leading-tight">
                        {{ \App\Models\SiteContent::get('about_title', 'Our Story') }}
                    </h2>
                    <p class="mt-4 text-xl italic text-yellow-200">
                        {{ \App\Models\SiteContent::get('about_subtitle', 'Contemporary Design. Crafted by Culture.') }}
                    </p>
                    <div class="mt-8 w-16 border-t-2 border-yellow-500"></div>
                    <p class="mt-8 text-lg leading-8 text-gray-300">
                        {{ \App\Models\SiteContent::get('about_desc_1', 'Setiap ruang di Corner Bisnis terinspirasi dari kerajinan tangan dan semangat gotong royong warga RT 04.') }}
                    </p>
                    <p class="mt-6 text-lg leading-8 text-gray-300">
                        {{ \App\Models\SiteContent::get('about_desc_2', 'Dinding maroon yang hangat, sentuhan kuning marigold, dan aksen kayu kenari berpadu menciptakan suasana yang terasa modern.') }}
                    </p>
                </div>
                <div class="relative">
                    <div class="overflow-hidden rounded-lg shadow-2xl">
                        <img src="{{ asset(\App\Models\SiteContent::get('about_image', 'images/2.avif')) }}"
                            alt="Interior" class="h-[500px] w-full object-cover">
                    </div>
                    <div class="absolute -bottom-6 -right-6 h-40 w-40 border-4 border-yellow-500"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== GRID USAHA ==================== --}}
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-16 text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-gray-500">
                    {{ \App\Models\SiteContent::get('business_label', 'Explore') }}
                </p>
                <h2 class="font-serif-display mt-4 text-4xl font-bold md:text-5xl">
                    {{ \App\Models\SiteContent::get('business_title', 'Usaha Warga RT 04') }}
                </h2>
                <div class="mx-auto mt-6 w-24 border-t-2 border-yellow-500"></div>
                <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600">
                    {{ \App\Models\SiteContent::get('business_subtitle', 'Jelajahi berbagai produk dan jasa yang dibuat langsung oleh warga sekitar.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @php
                $badgeColors = [
                1 => '#E91E63',
                2 => '#2196F3',
                3 => '#4CAF50',
                4 => '#FF9800',
                5 => '#9C27B0',
                ];
                @endphp

                @forelse ($businesses as $business)
                @php
                $badgeColor = $badgeColors[$business->category_id] ?? '#795548';
                @endphp

                <a href="{{ route('kos.show', $business->id) }}"
                    class="group block overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/' . $business->image) }}" alt="{{ $business->name }}"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-4 right-4 rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white shadow-md"
                            style="background-color: {{ $badgeColor }};">
                            {{ $business->category->name ?? 'Umum' }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900">{{ $business->type ?? $business->name }}</h3>
                        <p class="mt-2 text-sm leading-6 text-gray-600">
                            {{ $business->description ?? 'Deskripsi singkat usaha ini akan segera ditambahkan.' }}
                        </p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-900 hover:text-gray-600">
                                {{ \App\Models\SiteContent::get('business_view_detail', 'Lihat Detail →') }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $business->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-3 text-center py-20">
                    <p class="text-4xl">🏪</p>
                    <p class="mt-4 text-lg text-gray-500">
                        {{ \App\Models\SiteContent::get('business_empty', 'Belum ada usaha yang terdaftar.') }}
                    </p>
                </div>
                @endforelse
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('all-businesses') }}"
                    class="inline-block rounded-lg bg-gray-900 px-6 py-3 font-medium text-white transition hover:bg-yellow-500">
                    {{ \App\Models\SiteContent::get('business_view_all_button', 'Lihat Semua Usaha') }}
                </a>
            </div>
        </div>
    </section>

    {{-- ==================== TESTIMONI ==================== --}}
    <section class="relative bg-[#4a1e2b] text-white py-24 overflow-hidden">
        {{-- Decorative background --}}
        <div class="absolute inset-0 opacity-5"
            style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 20px 20px;">
        </div>

        <div class="relative z-10 mx-auto max-w-7xl px-6">
            <div class="text-center mb-16">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-yellow-500">
                    {{ \App\Models\SiteContent::get('testimonial_label', 'Testimonials') }}
                </p>
                <h2 class="font-serif-display mt-4 text-3xl md:text-4xl font-bold">
                    {{ \App\Models\SiteContent::get('testimonial_title', 'Apa Kata Mereka?') }}
                </h2>
                <div class="mx-auto mt-6 w-24 border-t-2 border-yellow-500"></div>
                <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-300">
                    {{ \App\Models\SiteContent::get('testimonial_subtitle', 'Pilih usaha lain yang mungkin cocok untuk kamu.') }}
                </p>
            </div>

            {{-- ⭐ GRID RESPONSIVE - otomatis ngatur jumlah kolom --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 auto-rows-fr">
                @forelse ($testimonials as $testimonial)
                {{-- ⭐ CARD DENGAN DESIGN LEBIH BAIK --}}
                <div class="group relative flex flex-col rounded-2xl bg-gradient-to-br from-white/10 to-white/5 p-6 backdrop-blur-sm border border-white/10 transition-all duration-300 hover:-translate-y-2 hover:bg-white/15 hover:shadow-2xl hover:border-yellow-500/30">

                    {{-- Quote icon --}}
                    <div class="absolute -top-3 -left-3 w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center shadow-lg">
                        <i class="fas fa-quote-left text-[#4a1e2b] text-sm"></i>
                    </div>

                    {{-- Star rating --}}
                    <div class="flex items-center gap-1 text-yellow-400 mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <=($testimonial->rating ?? 5))
                            <span>★</span>
                            @else
                            <span class="text-gray-500">★</span>
                            @endif
                            @endfor
                    </div>

                    {{-- Content --}}
                    <p class="text-base italic leading-7 text-gray-200 flex-grow">
                        "{{ $testimonial->content }}"
                    </p>

                    {{-- Author --}}
                    <div class="mt-6 pt-4 border-t border-white/10 flex items-center gap-3">
                        <img src="{{ $testimonial->image ? asset('images/' . $testimonial->image) : asset('images/3.avif') }}"
                            alt="{{ $testimonial->name }}"
                            class="h-12 w-12 rounded-full object-cover border-2 border-yellow-500/50 transition-transform duration-300 group-hover:scale-110">
                        <div>
                            <p class="font-semibold text-white">{{ $testimonial->name }}</p>
                            <p class="text-xs text-gray-400">Warga RT 04</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/10 mb-4">
                        <i class="fas fa-comments text-3xl text-yellow-500"></i>
                    </div>
                    <p class="mt-4 text-lg text-gray-300">
                        {{ \App\Models\SiteContent::get('testimonial_empty', 'Belum ada testimoni.') }}
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ==================== CTA ==================== --}}
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mx-auto max-w-4xl rounded-2xl bg-gradient-to-r from-yellow-500 to-yellow-400 p-12 text-center shadow-xl">
                <h2 class="font-serif-display text-3xl font-bold text-white md:text-4xl">
                    {{ \App\Models\SiteContent::get('cta_title', 'Punya Usaha di RT 04?') }}
                </h2>
                <p class="mt-4 text-lg text-white/90">
                    {{ \App\Models\SiteContent::get('cta_desc', 'Daftarkan usaha kamu sekarang dan biar lebih banyak warga yang tahu!') }}
                </p>
                <div class="mt-8">
                    <a href="https://wa.me/{{ \App\Models\SiteContent::get('contact_whatsapp', '6281234567890') }}?text=Halo%20Admin%2C%20saya%20ingin%20daftar%20usaha%20di%20Corner%20Bisnis%20RT%2004"
                        target="_blank"
                        class="inline-block rounded-lg bg-white px-6 py-3 font-medium text-gray-900 transition hover:bg-gray-100">
                        {{ \App\Models\SiteContent::get('cta_button', 'Daftar Sekarang') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== STATISTIK ==================== --}}
    <section class="bg-gray-50 py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#4a1e2b]">{{ $totalBusinesses }}+</p>
                    <p class="mt-2 text-sm font-semibold uppercase tracking-wider text-gray-500">
                        {{ \App\Models\SiteContent::get('stat_business_label', 'Usaha Terdaftar') }}
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#4a1e2b]">{{ $totalCategories }}+</p>
                    <p class="mt-2 text-sm font-semibold uppercase tracking-wider text-gray-500">
                        {{ \App\Models\SiteContent::get('stat_category_label', 'Kategori Usaha') }}
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#4a1e2b]">
                        {{ \App\Models\SiteContent::get('stat_access', '24/7') }}
                    </p>
                    <p class="mt-2 text-sm font-semibold uppercase tracking-wider text-gray-500">
                        {{ \App\Models\SiteContent::get('stat_access_label', 'Akses Online') }}
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#4a1e2b]">
                        {{ \App\Models\SiteContent::get('stat_helped', '100%') }}
                    </p>
                    <p class="mt-2 text-sm font-semibold uppercase tracking-wider text-gray-500">
                        {{ \App\Models\SiteContent::get('stat_helped_label', 'Warga Terbantu') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="bg-[#4a1e2b] text-white py-16">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-12 md:grid-cols-3">
                <div>
                    <h3 class="text-2xl font-bold tracking-widest uppercase">
                        {{ \App\Models\SiteContent::get('footer_title', 'RT 04 NGIJO') }}
                    </h3>
                    <p class="mt-4 text-sm leading-6 text-gray-300">
                        {{ \App\Models\SiteContent::get('footer_desc', 'Corner Bisnis RT 04 Ngijo adalah platform untuk memamerkan dan mempromosikan berbagai usaha kecil dan menengah yang dikelola oleh warga sekitar.') }}
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-yellow-500">
                        {{ \App\Models\SiteContent::get('footer_nav_title', 'Navigasi') }}
                    </h4>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-yellow-400">{{ \App\Models\SiteContent::get('footer_nav_home', 'Halaman Utama') }}</a></li>
                        <li><a href="{{ route('all-businesses') }}" class="hover:text-yellow-400">{{ \App\Models\SiteContent::get('footer_nav_business', 'Semua Usaha') }}</a></li>
                        <li><a href="https://wa.me/{{ \App\Models\SiteContent::get('contact_whatsapp', '6281234567890') }}?text=Halo%20Admin%2C%20saya%20ingin%20daftar%20usaha"
                                target="_blank" class="hover:text-yellow-400">{{ \App\Models\SiteContent::get('footer_nav_register', 'Daftar Usaha') }}</a></li>
                        <li><a href="{{ route('home') }}#tentang" class="hover:text-yellow-400">{{ \App\Models\SiteContent::get('footer_nav_about', 'Tentang Kami') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-yellow-500">
                        {{ \App\Models\SiteContent::get('footer_contact_title', 'Kontak') }}
                    </h4>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li>📍 {{ \App\Models\SiteContent::get('contact_address', 'RT 04 Ngijo, Karangploso, Malang') }}</li>
                        <li>📞 {{ \App\Models\SiteContent::get('contact_phone', '+62 812-3456-7890') }}</li>
                        <li>📧 {{ \App\Models\SiteContent::get('contact_email', 'cornerbisnis@gmail.com') }}</li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 border-t border-white/10 pt-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} {{ \App\Models\SiteContent::get('footer_copyright', 'Corner Bisnis RT 04 Ngijo. Semua Hak Dilindungi.') }}
            </div>
        </div>
    </footer>

    {{-- ==================== SCRIPT ==================== --}}
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.hero-dot');
        let currentSlide = 0;
        let slideInterval = null;
        const SLIDE_DURATION = 5000;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('opacity-100', 'active');
                slide.classList.add('opacity-0');
            });
            if (slides[index]) {
                slides[index].classList.remove('opacity-0');
                slides[index].classList.add('opacity-100', 'active');
            }
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('bg-white', 'w-8');
                    dot.classList.remove('bg-white/50');
                } else {
                    dot.classList.remove('bg-white', 'w-8');
                    dot.classList.add('bg-white/50');
                }
            });
            currentSlide = index;
        }

        function nextSlide() {
            const next = (currentSlide + 1) % slides.length;
            showSlide(next);
        }

        function goToSlide(index) {
            showSlide(index);
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, SLIDE_DURATION);
        }

        if (slides.length > 0) {
            slideInterval = setInterval(nextSlide, SLIDE_DURATION);
        }

        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                clearInterval(slideInterval);
            } else {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, SLIDE_DURATION);
            }
        });
    </script>

</body>

</html>