<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corner Bisnis RT 04 Ngijo</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

    @include('partials.navbar')

    <!-- Hero Section (Full Screen) -->
    <section class="relative flex h-screen w-full items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/1.avif') }}');">
            <div id="hero-overlay"
                class="absolute inset-0 bg-black opacity-40 transition-opacity duration-100 ease-out"></div>
        </div>

        <!-- Konten Hero -->
        <div class="relative z-10 mx-auto max-w-4xl px-6 pt-24 pb-10 text-center text-white">
            <p class="text-sm font-semibold uppercase tracking-wider text-gray-300">RT 04 Ngijo</p>
            <h1 class="font-serif-display mt-3 text-4xl font-bold tracking-tight md:text-6xl">Corner Bisnis<br>RT 04
                Ngijo</h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-200">Temukan berbagai usaha dan jasa yang
                dijalankan oleh warga RT 04 Ngijo.</p>
            <div class="mt-8">
                <a href="#usaha"
                    class="inline-block rounded-lg bg-yellow-500 px-6 py-3 font-medium text-white shadow-lg transition hover:bg-yellow-400">Lihat
                    Usaha Warga</a>
            </div>
        </div>
    </section>

    <!-- SECTION 2: LAYOUT 2 KOLOM -->
    <section class="relative bg-[#4a1e2b] text-white py-24">
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 20px 20px;">
        </div>
        <div class="relative z-10 mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-16 lg:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-yellow-500">Design Philosophy</p>
                    <h2 class="font-serif-display mt-6 text-5xl font-bold leading-tight">Our Story</h2>
                    <p class="mt-4 text-xl italic text-yellow-200">Contemporary Design. Crafted by Culture.</p>
                    <div class="mt-8 w-16 border-t-2 border-yellow-500"></div>
                    <p class="mt-8 text-lg leading-8 text-gray-300">Setiap ruang di Corner Bisnis terinspirasi dari
                        kerajinan tangan dan semangat gotong royong warga RT 04.</p>
                    <p class="mt-6 text-lg leading-8 text-gray-300">Dinding maroon yang hangat, sentuhan kuning
                        marigold, dan aksen kayu kenari berpadu menciptakan suasana yang terasa modern.</p>
                </div>
                <div class="relative">
                    <div class="overflow-hidden rounded-lg shadow-2xl"><img src="{{ asset('images/2.avif') }}"
                            alt="Interior" class="h-[500px] w-full object-cover"></div>
                    <div class="absolute -bottom-6 -right-6 h-40 w-40 border-4 border-yellow-500"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: GRID USAHA WARGA (3 TERATAS) -->
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-16 text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-gray-500">Explore</p>
                <h2 class="font-serif-display mt-4 text-4xl font-bold md:text-5xl">Usaha Warga RT 04</h2>
                <div class="mx-auto mt-6 w-24 border-t-2 border-yellow-500"></div>
                <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600">Jelajahi berbagai produk dan jasa yang dibuat
                    langsung oleh warga sekitar.</p>
            </div>

            <!-- Grid Kartu Usaha -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @php
                $badgeColors = [
                1 => '#E91E63', // Kos: Pink
                2 => '#2196F3', // Kuliner: Biru
                3 => '#4CAF50', // Laundry: Hijau
                4 => '#FF9800', // Jasa: Orange
                5 => '#9C27B0', // Toko: Ungu
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
                            <span class="text-sm font-semibold text-gray-900 hover:text-gray-600">Lihat Detail →</span>
                            <span class="text-xs text-gray-400">{{ $business->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-3 text-center py-20">
                    <p class="text-4xl">🏪</p>
                    <p class="mt-4 text-lg text-gray-500">Belum ada usaha yang terdaftar.</p>
                </div>
                @endforelse
            </div>

            <!-- Tombol Lihat Selengkapnya -->
            <div class="mt-16 text-center">
                <a href="{{ route('all-businesses') }}"
                    class="inline-block rounded-lg bg-gray-900 px-6 py-3 font-medium text-white transition hover:bg-yellow-500">Lihat
                    Semua Usaha</a>
            </div>
        </div>
    </section>

    <!-- SECTION 4: TESTIMONI -->
    <section class="relative bg-[#4a1e2b] text-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-yellow-500">Testimonials</p>
                <h2 class="font-serif-display mt-4 text-3xl font-bold">Apa Kata Mereka?</h2>
                <div class="mx-auto mt-6 w-24 border-t-2 border-yellow-500"></div>
                <p class="mx-auto mt-6 mb-6 max-w-2xl text-lg text-gray-300">Pilih usaha lain yang mungkin cocok untuk
                    kamu.</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                @forelse ($testimonials as $testimonial)
                <div class="rounded-lg bg-white/10 p-6 backdrop-blur-sm">
                    <div class="flex items-center gap-1 text-yellow-400">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="mt-4 text-lg italic leading-7 text-gray-200">
                        {{ $testimonial->content }}
                    </p>
                    <div class="mt-6 flex items-center gap-3">
                        <img src="{{ $testimonial->image ?? asset('images/3.avif') }}" alt="Warga"
                            class="h-12 w-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold">{{ $testimonial->name }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-20">
                    <p class="text-4xl">🏪</p>
                    <p class="mt-4 text-lg text-gray-500">Belum ada testimoni.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- SECTION 5: CALL TO ACTION -->
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div
                class="mx-auto max-w-4xl rounded-2xl bg-gradient-to-r from-yellow-500 to-yellow-400 p-12 text-center shadow-xl">
                <h2 class="font-serif-display text-3xl font-bold text-white md:text-4xl">Punya Usaha di RT 04?</h2>
                <p class="mt-4 text-lg text-white/90">Daftarkan usaha kamu sekarang dan biar lebih banyak warga yang
                    tahu!</p>
                <div class="mt-8">
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20daftar%20usaha%20di%20Corner%20Bisnis%20RT%2004"
                        target="_blank"
                        class="inline-block rounded-lg bg-white px-6 py-3 font-medium text-gray-900 transition hover:bg-gray-100">Daftar
                        Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: STATISTIK -->
    <section class="bg-gray-50 py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#4a1e2b]">{{ $totalBusinesses }}+</p>
                    <p class="mt-2 text-sm font-semibold uppercase tracking-wider text-gray-500">Usaha Terdaftar</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#4a1e2b]">{{ $totalCategories }}+</p>
                    <p class="mt-2 text-sm font-semibold uppercase tracking-wider text-gray-500">Kategori Usaha</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#4a1e2b]">24/7</p>
                    <p class="mt-2 text-sm font-semibold uppercase tracking-wider text-gray-500">Akses Online</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#4a1e2b]">100%</p>
                    <p class="mt-2 text-sm font-semibold uppercase tracking-wider text-gray-500">Warga Terbantu</p>
                </div>
            </div>
        </div>
    </section>

   <!-- SECTION 7: FOOTER -->
    <footer class="bg-[#4a1e2b] text-white py-16">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-12 md:grid-cols-3">
                <div>
                    <h3 class="text-2xl font-bold tracking-widest uppercase">RT 04 NGIJO</h3>
                    <p class="mt-4 text-sm leading-6 text-gray-300">Corner Bisnis RT 04 Ngijo adalah platform untuk
                        memamerkan dan mempromosikan berbagai usaha kecil dan menengah yang dikelola oleh warga sekitar.
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-yellow-500">Navigasi</h4>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-yellow-400">Halaman Utama</a></li>
                        <li><a href="{{ route('all-businesses') }}" class="hover:text-yellow-400">Semua Usaha</a></li>
                        <li><a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20daftar%20usaha"
                                target="_blank" class="hover:text-yellow-400">Daftar Usaha</a></li>
                        <li><a href="{{ route('home') }}#tentang" class="hover:text-yellow-400">Tentang Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-yellow-500">Kontak</h4>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li>📍 RT 04 Ngijo, Karangploso, Malang</li>
                        <li>📞 +62 812-3456-7890</li>
                        <li>📧 cornerbisnis@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 border-t border-white/10 pt-8 text-center text-sm text-gray-400">&copy; {{ date('Y') }}
                Corner Bisnis RT 04 Ngijo. Semua Hak Dilindungi.</div>
        </div>
    </footer>

    <!-- Script Navbar -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>

</html>