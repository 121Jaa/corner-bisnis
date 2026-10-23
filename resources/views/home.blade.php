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

        /* ⭐ HERO TITLE DINAMIS (dari admin) */
        .hero-title-dynamic {
            font-size: calc(var(--title-size) * 0.5);
            color: var(--title-color);
            line-height: 1.1;
        }

        @media (min-width: 640px) {
            .hero-title-dynamic {
                font-size: calc(var(--title-size) * 0.75);
            }
        }

        @media (min-width: 1024px) {
            .hero-title-dynamic {
                font-size: var(--title-size);
            }
        }

        /* ⭐ HERO SUBTITLE DINAMIS (dari admin) */
        .hero-subtitle-dynamic {
            font-size: calc(var(--subtitle-size) * 0.9);
            color: var(--subtitle-color);
            line-height: 1.6;
        }

        @media (min-width: 1024px) {
            .hero-subtitle-dynamic {
                font-size: var(--subtitle-size);
            }
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

        @php
            // ⭐ Ambil style dari SiteContent (bisa diatur di /admin/hero)
            $heroBadge = \App\Models\SiteContent::get('hero_badge', 'RT 04 Ngijo');
            $heroBadgeSize = \App\Models\SiteContent::get('hero_badge_size', 14);
            $heroBadgeColor = \App\Models\SiteContent::get('hero_badge_color', '#fbbf24');
            
            $heroTitle = \App\Models\SiteContent::get('hero_title', 'Corner Bisnis<br>RT 04 Ngijo');
            $heroTitleSize = \App\Models\SiteContent::get('hero_title_size', 60);
            $heroTitleColor = \App\Models\SiteContent::get('hero_title_color', '#ffffff');
            
            $heroSubtitle = \App\Models\SiteContent::get('hero_subtitle', 'Temukan berbagai usaha dan jasa yang dijalankan oleh warga RT 04 Ngijo.');
            $heroSubtitleSize = \App\Models\SiteContent::get('hero_subtitle_size', 18);
            $heroSubtitleColor = \App\Models\SiteContent::get('hero_subtitle_color', '#e5e7eb');
        @endphp

        <div class="relative z-20 mx-auto max-w-4xl px-6 pt-24 pb-10 text-center">
            @if ($heroBadge)
            <p class="font-semibold uppercase tracking-wider animate-fade-in-down"
                style="color: {{ $heroBadgeColor }}; font-size: {{ $heroBadgeSize }}px;">
                {{ $heroBadge }}
            </p>
            @endif
            
            <h1 class="font-serif-display mt-3 font-bold tracking-tight animate-fade-in-up hero-title-dynamic"
                style="--title-size: {{ $heroTitleSize }}px; --title-color: {{ $heroTitleColor }};">
                {!! $heroTitle !!}
            </h1>
            
            @if ($heroSubtitle)
            <p class="mx-auto mt-6 max-w-2xl animate-fade-in-up delay-200 hero-subtitle-dynamic"
                style="--subtitle-size: {{ $heroSubtitleSize }}px; --subtitle-color: {{ $heroSubtitleColor }};">
                {{ $heroSubtitle }}
            </p>
            @endif
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
    @php
        $aboutLabel = \App\Models\SiteContent::get('about_label', 'Design Philosophy');
        $aboutLabelSize = \App\Models\SiteContent::get('about_label_size', 14);
        $aboutLabelColor = \App\Models\SiteContent::get('about_label_color', '#eab308');
        
        $aboutTitle = \App\Models\SiteContent::get('about_title', 'Our Story');
        $aboutTitleSize = \App\Models\SiteContent::get('about_title_size', 48);
        $aboutTitleColor = \App\Models\SiteContent::get('about_title_color', '#ffffff');
        
        $aboutSubtitle = \App\Models\SiteContent::get('about_subtitle', 'Contemporary Design. Crafted by Culture.');
        $aboutSubtitleSize = \App\Models\SiteContent::get('about_subtitle_size', 20);
        $aboutSubtitleColor = \App\Models\SiteContent::get('about_subtitle_color', '#fef08a');
        
        $aboutDesc1 = \App\Models\SiteContent::get('about_desc_1', 'Setiap ruang di Corner Bisnis terinspirasi dari kerajinan tangan dan semangat gotong royong warga RT 04.');
        $aboutDesc2 = \App\Models\SiteContent::get('about_desc_2', 'Dinding maroon yang hangat, sentuhan kuning marigold, dan aksen kayu kenari berpadu menciptakan suasana yang terasa modern.');
        
        $aboutDescSize = \App\Models\SiteContent::get('about_desc_size', 18);
        $aboutDescColor = \App\Models\SiteContent::get('about_desc_color', '#d1d5db');
    @endphp

    <section class="relative bg-[#4a1e2b] text-white py-24">
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 20px 20px;">
        </div>
        <div class="relative z-10 mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-16 lg:grid-cols-2">
                
                {{-- KOLOM KIRI (TEXT) --}}
                <div>
                    <p class="font-semibold uppercase tracking-[0.3em]"
                        style="color: {{ $aboutLabelColor }}; font-size: {{ $aboutLabelSize }}px;">
                        {{ $aboutLabel }}
                    </p>
                    
                    <h2 class="font-serif-display mt-6 font-bold leading-tight"
                        style="color: {{ $aboutTitleColor }}; font-size: {{ $aboutTitleSize }}px;">
                        {{ $aboutTitle }}
                    </h2>
                    
                    @if ($aboutSubtitle)
                    <p class="mt-4 italic"
                        style="color: {{ $aboutSubtitleColor }}; font-size: {{ $aboutSubtitleSize }}px;">
                        {{ $aboutSubtitle }}
                    </p>
                    @endif
                    
                    <div class="mt-8 w-16 border-t-2 border-yellow-500"></div>
                    
                    @if ($aboutDesc1)
                    <p class="mt-8 leading-8"
                        style="color: {{ $aboutDescColor }}; font-size: {{ $aboutDescSize }}px;">
                        {{ $aboutDesc1 }}
                    </p>
                    @endif
                    
                    @if ($aboutDesc2)
                    <p class="mt-6 leading-8"
                        style="color: {{ $aboutDescColor }}; font-size: {{ $aboutDescSize }}px;">
                        {{ $aboutDesc2 }}
                    </p>
                    @endif
                </div>

                {{-- KOLOM KANAN (GAMBAR) --}}
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
            @php
                $bizLabel = \App\Models\SiteContent::get('business_label', 'Explore');
                $bizLabelSize = \App\Models\SiteContent::get('business_label_size', 14);
                $bizLabelColor = \App\Models\SiteContent::get('business_label_color', '#6b7280');
                $bizTitle = \App\Models\SiteContent::get('business_title', 'Usaha Warga RT 04');
                $bizTitleSize = \App\Models\SiteContent::get('business_title_size', 40);
                $bizTitleColor = \App\Models\SiteContent::get('business_title_color', '#111827');
                $bizSubtitle = \App\Models\SiteContent::get('business_subtitle', 'Jelajahi berbagai produk dan jasa yang dibuat langsung oleh warga sekitar.');
                $bizSubtitleSize = \App\Models\SiteContent::get('business_subtitle_size', 18);
                $bizSubtitleColor = \App\Models\SiteContent::get('business_subtitle_color', '#4b5563');
            @endphp

            <div class="mb-16 text-center">
                <p class="font-semibold uppercase tracking-[0.3em]"
                    style="color: {{ $bizLabelColor }}; font-size: {{ $bizLabelSize }}px;">
                    {{ $bizLabel }}
                </p>
                <h2 class="font-serif-display mt-4 font-bold"
                    style="color: {{ $bizTitleColor }}; font-size: {{ $bizTitleSize }}px;">
                    {{ $bizTitle }}
                </h2>
                <div class="mx-auto mt-6 w-24 border-t-2 border-yellow-500"></div>
                <p class="mx-auto mt-6 max-w-2xl"
                    style="color: {{ $bizSubtitleColor }}; font-size: {{ $bizSubtitleSize }}px;">
                    {{ $bizSubtitle }}
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
                            @php
                                $bizDetailText = \App\Models\SiteContent::get('business_view_detail', 'Lihat Detail →');
                                $bizDetailSize = \App\Models\SiteContent::get('business_view_detail_size', 14);
                                $bizDetailColor = \App\Models\SiteContent::get('business_view_detail_color', '#111827');
                            @endphp
                            <span class="font-semibold hover:opacity-70"
                                style="font-size: {{ $bizDetailSize }}px; color: {{ $bizDetailColor }};">
                                {{ $bizDetailText }}
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
                @php
                    $bizAllText = \App\Models\SiteContent::get('business_view_all_button', 'Lihat Semua Usaha');
                    $bizAllSize = \App\Models\SiteContent::get('business_view_all_button_size', 16);
                    $bizAllColor = \App\Models\SiteContent::get('business_view_all_button_color', '#ffffff');
                @endphp
                <a href="{{ route('all-businesses') }}"
                    class="inline-block rounded-lg bg-gray-900 px-6 py-3 font-medium transition hover:bg-yellow-500"
                    style="font-size: {{ $bizAllSize }}px; color: {{ $bizAllColor }};">
                    {{ $bizAllText }}
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
            @php
                $testiLabel = \App\Models\SiteContent::get('testimonial_label', 'Testimonials');
                $testiLabelSize = \App\Models\SiteContent::get('testimonial_label_size', 14);
                $testiLabelColor = \App\Models\SiteContent::get('testimonial_label_color', '#eab308');
                $testiTitle = \App\Models\SiteContent::get('testimonial_title', 'Apa Kata Mereka?');
                $testiTitleSize = \App\Models\SiteContent::get('testimonial_title_size', 36);
                $testiTitleColor = \App\Models\SiteContent::get('testimonial_title_color', '#ffffff');
                $testiSubtitle = \App\Models\SiteContent::get('testimonial_subtitle', 'Pilih usaha lain yang mungkin cocok untuk kamu.');
                $testiSubtitleSize = \App\Models\SiteContent::get('testimonial_subtitle_size', 18);
                $testiSubtitleColor = \App\Models\SiteContent::get('testimonial_subtitle_color', '#d1d5db');
            @endphp

            <div class="text-center mb-16">
                <p class="font-semibold uppercase tracking-[0.3em]"
                    style="color: {{ $testiLabelColor }}; font-size: {{ $testiLabelSize }}px;">
                    {{ $testiLabel }}
                </p>
                <h2 class="font-serif-display mt-4 font-bold"
                    style="color: {{ $testiTitleColor }}; font-size: {{ $testiTitleSize }}px;">
                    {{ $testiTitle }}
                </h2>
                <div class="mx-auto mt-6 w-24 border-t-2 border-yellow-500"></div>
                <p class="mx-auto mt-6 max-w-2xl"
                    style="color: {{ $testiSubtitleColor }}; font-size: {{ $testiSubtitleSize }}px;">
                    {{ $testiSubtitle }}
                </p>
            </div>

            {{-- GRID RESPONSIVE --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 auto-rows-fr">
                @forelse ($testimonials as $testimonial)
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
                        @php
                            $hasImage = !empty($testimonial->image)
                            && is_string($testimonial->image)
                            && file_exists(public_path('images/' . $testimonial->image));

                            $name = trim($testimonial->name ?? 'Anonim');
                            $nameParts = preg_split('/\s+/', $name);
                            $initials = '';
                            foreach (array_slice($nameParts, 0, 2) as $part) {
                                $initials .= strtoupper(mb_substr($part, 0, 1));
                            }
                            if (empty($initials)) $initials = '?';

                            $colors = [
                                'from-pink-500 to-rose-600',
                                'from-blue-500 to-indigo-600',
                                'from-green-500 to-emerald-600',
                                'from-yellow-500 to-orange-600',
                                'from-purple-500 to-violet-600',
                                'from-cyan-500 to-teal-600',
                                'from-red-500 to-rose-600',
                                'from-amber-500 to-orange-600',
                            ];
                            $colorIndex = abs(crc32($name)) % count($colors);
                            $colorClass = $colors[$colorIndex];
                        @endphp

                        @if ($hasImage)
                        <img src="{{ asset('images/' . $testimonial->image) }}"
                            alt="{{ $testimonial->name }}"
                            class="h-12 w-12 rounded-full object-cover border-2 border-yellow-500/50 transition-transform duration-300 group-hover:scale-110"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="hidden h-12 w-12 rounded-full bg-gradient-to-br {{ $colorClass }} items-center justify-center border-2 border-yellow-500/50 text-white font-bold text-sm shadow-lg">
                            {{ $initials }}
                        </div>
                        @else
                        <div class="flex h-12 w-12 rounded-full bg-gradient-to-br {{ $colorClass }} items-center justify-center border-2 border-yellow-500/50 text-white font-bold text-sm shadow-lg transition-transform duration-300 group-hover:scale-110">
                            {{ $initials }}
                        </div>
                        @endif

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
    @php
        $ctaTitle = \App\Models\SiteContent::get('cta_title', 'Punya Usaha di RT 04?');
        $ctaTitleSize = \App\Models\SiteContent::get('cta_title_size', 36);
        $ctaTitleColor = \App\Models\SiteContent::get('cta_title_color', '#ffffff');
        $ctaDesc = \App\Models\SiteContent::get('cta_desc', 'Daftarkan usaha kamu sekarang dan biar lebih banyak warga yang tahu!');
        $ctaDescSize = \App\Models\SiteContent::get('cta_desc_size', 18);
        $ctaDescColor = \App\Models\SiteContent::get('cta_desc_color', '#ffffff');
        $ctaButton = \App\Models\SiteContent::get('cta_button', 'Daftar Sekarang');
        $ctaButtonColor = \App\Models\SiteContent::get('cta_button_color', '#111827');
    @endphp

    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mx-auto max-w-4xl rounded-2xl bg-gradient-to-r from-yellow-500 to-yellow-400 p-12 text-center shadow-xl">
                <h2 class="font-serif-display font-bold"
                    style="color: {{ $ctaTitleColor }}; font-size: {{ $ctaTitleSize }}px;">
                    {{ $ctaTitle }}
                </h2>
                <p class="mt-4" style="color: {{ $ctaDescColor }}; font-size: {{ $ctaDescSize }}px;">
                    {{ $ctaDesc }}
                </p>
                <div class="mt-8">
                    <a href="https://wa.me/{{ \App\Models\SiteContent::get('contact_whatsapp', '6281234567890') }}?text=Halo%20Admin%2C%20saya%20ingin%20daftar%20usaha%20di%20Corner%20Bisnis%20RT%2004"
                        target="_blank"
                        class="inline-block rounded-lg bg-white px-6 py-3 font-medium transition hover:bg-gray-100"
                        style="color: {{ $ctaButtonColor }};">
                        {{ $ctaButton }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== STATISTIK ==================== --}}
    @php
        // Tarik semua style
        $sAccessValue = \App\Models\SiteContent::get('stat_access', '24/7');
        $sAccessSize = \App\Models\SiteContent::get('stat_access_size', 36);
        $sAccessColor = \App\Models\SiteContent::get('stat_access_color', '#4a1e2b');
        $sAccessLabel = \App\Models\SiteContent::get('stat_access_label', 'Akses Online');
        $sAccessLabelSize = \App\Models\SiteContent::get('stat_access_label_size', 14);
        $sAccessLabelColor = \App\Models\SiteContent::get('stat_access_label_color', '#6b7280');

        $sHelpedValue = \App\Models\SiteContent::get('stat_helped', '100%');
        $sHelpedSize = \App\Models\SiteContent::get('stat_helped_size', 36);
        $sHelpedColor = \App\Models\SiteContent::get('stat_helped_color', '#4a1e2b');
        $sHelpedLabel = \App\Models\SiteContent::get('stat_helped_label', 'Warga Terbantu');
        $sHelpedLabelSize = \App\Models\SiteContent::get('stat_helped_label_size', 14);
        $sHelpedLabelColor = \App\Models\SiteContent::get('stat_helped_label_color', '#6b7280');

        $sBizLabel = \App\Models\SiteContent::get('stat_business_label', 'Usaha Terdaftar');
        $sBizSize = \App\Models\SiteContent::get('stat_business_size', 36);
        $sBizColor = \App\Models\SiteContent::get('stat_business_color', '#4a1e2b');
        $sBizLabelSize = \App\Models\SiteContent::get('stat_business_label_size', 14);
        $sBizLabelColor = \App\Models\SiteContent::get('stat_business_label_color', '#6b7280');

        $sCatLabel = \App\Models\SiteContent::get('stat_category_label', 'Kategori Usaha');
        $sCatSize = \App\Models\SiteContent::get('stat_category_size', 36);
        $sCatColor = \App\Models\SiteContent::get('stat_category_color', '#4a1e2b');
        $sCatLabelSize = \App\Models\SiteContent::get('stat_category_label_size', 14);
        $sCatLabelColor = \App\Models\SiteContent::get('stat_category_label_color', '#6b7280');
    @endphp

    <section class="bg-gray-50 py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                {{-- Usaha Terdaftar --}}
                <div class="text-center">
                    <p class="font-bold" style="font-size: {{ $sBizSize }}px; color: {{ $sBizColor }};">
                        {{ $totalBusinesses }}+
                    </p>
                    <p class="mt-2 font-semibold uppercase tracking-wider"
                        style="font-size: {{ $sBizLabelSize }}px; color: {{ $sBizLabelColor }};">
                        {{ $sBizLabel }}
                    </p>
                </div>
                {{-- Kategori Usaha --}}
                <div class="text-center">
                    <p class="font-bold" style="font-size: {{ $sCatSize }}px; color: {{ $sCatColor }};">
                        {{ $totalCategories }}+
                    </p>
                    <p class="mt-2 font-semibold uppercase tracking-wider"
                        style="font-size: {{ $sCatLabelSize }}px; color: {{ $sCatLabelColor }};">
                        {{ $sCatLabel }}
                    </p>
                </div>
                {{-- Akses Online --}}
                <div class="text-center">
                    <p class="font-bold" style="font-size: {{ $sAccessSize }}px; color: {{ $sAccessColor }};">
                        {{ $sAccessValue }}
                    </p>
                    <p class="mt-2 font-semibold uppercase tracking-wider"
                        style="font-size: {{ $sAccessLabelSize }}px; color: {{ $sAccessLabelColor }};">
                        {{ $sAccessLabel }}
                    </p>
                </div>
                {{-- Warga Terbantu --}}
                <div class="text-center">
                    <p class="font-bold" style="font-size: {{ $sHelpedSize }}px; color: {{ $sHelpedColor }};">
                        {{ $sHelpedValue }}
                    </p>
                    <p class="mt-2 font-semibold uppercase tracking-wider"
                        style="font-size: {{ $sHelpedLabelSize }}px; color: {{ $sHelpedLabelColor }};">
                        {{ $sHelpedLabel }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== FOOTER ==================== --}}
    @php
        $ftTitle = \App\Models\SiteContent::get('footer_title', 'RT 04 NGIJO');
        $ftTitleSize = \App\Models\SiteContent::get('footer_title_size', 24);
        $ftTitleColor = \App\Models\SiteContent::get('footer_title_color', '#ffffff');
        $ftDesc = \App\Models\SiteContent::get('footer_desc', 'Corner Bisnis RT 04 Ngijo adalah platform untuk memamerkan dan mempromosikan berbagai usaha kecil dan menengah yang dikelola oleh warga sekitar.');
        $ftDescSize = \App\Models\SiteContent::get('footer_desc_size', 14);
        $ftDescColor = \App\Models\SiteContent::get('footer_desc_color', '#d1d5db');
    @endphp

    <footer class="bg-[#4a1e2b] text-white py-16">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-12 md:grid-cols-3">
                <div>
                    <h3 class="font-bold tracking-widest uppercase"
                        style="color: {{ $ftTitleColor }}; font-size: {{ $ftTitleSize }}px;">
                        {{ $ftTitle }}
                    </h3>
                    <p class="mt-4 leading-6"
                        style="color: {{ $ftDescColor }}; font-size: {{ $ftDescSize }}px;">
                        {{ $ftDesc }}
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