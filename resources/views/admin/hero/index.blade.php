<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Slideshow - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F8F4F0]">

    <div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-gradient-to-r from-[#2B0F1A] to-[#4A1E2B] text-white px-4 py-3 flex items-center justify-between shadow-lg">
        <button class="text-2xl p-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="font-serif text-lg font-bold tracking-wide">RT 04 NGIJO</h1>
        <div class="w-10"></div>
    </div>

    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <div class="min-h-screen flex pt-14 lg:pt-0">

        {{-- Sidebar --}}
        <div id="sidebar" class="fixed lg:static inset-y-0 left-0 w-72 bg-gradient-to-b from-[#2B0F1A] to-[#4A1E2B] text-white flex flex-col shadow-2xl z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
            <div class="relative z-10 p-6 overflow-y-auto h-full">

                <div class="flex items-center justify-between gap-3 pb-6">
                    <div class="flex items-center gap-3">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M3 10v11m18-11v11M9 10V7m3 3V7m3 3V7" />
                        </svg>
                        <div>
                            <h1 class="font-serif text-xl lg:text-2xl font-bold tracking-wide">RT 04 NGIJO</h1>
                            <p class="text-xs uppercase tracking-[0.3em] opacity-60">Admin Panel</p>
                        </div>
                    </div>
                    <button class="lg:hidden text-2xl p-2" onclick="toggleSidebar()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="mb-6 p-3 rounded-xl bg-white/5 border border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center text-[#4a1e2b] font-bold text-sm shrink-0">
                            {{ strtoupper(substr(auth()->user()->display_name ?? auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-white truncate">
                                {{ auth()->user()->display_name ?? auth()->user()->name }}
                            </p>
                            <p class="text-[10px] font-semibold uppercase tracking-wider {{ auth()->user()->role_color }} inline-block px-2 py-0.5 rounded-full border mt-1">
                                {{ auth()->user()->role_label }}
                            </p>
                        </div>
                    </div>
                </div>

                @php
                $activeClass = 'bg-white/10 shadow-inner';

                function navClass($patterns, $activeClass) {
                    foreach ((array) $patterns as $pattern) {
                        if (request()->routeIs($pattern) || request()->is($pattern)) {
                            return $activeClass;
                        }
                    }
                    return '';
                }
                @endphp

                <div class="space-y-6">
                    <div>
                        <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Main</p>
                        <div class="space-y-1">
                            <a href="/" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ navClass('home', $activeClass) }}">
                                <i class="fas fa-home w-5 h-5"></i>
                                <span class="text-sm font-semibold">Home</span>
                            </a>
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ navClass('dashboard', $activeClass) }}">
                                <i class="fas fa-chart-pie w-5 h-5"></i>
                                <span class="text-sm font-semibold">Dashboard</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Kelola Data</p>
                        <div class="space-y-1">
                            <a href="{{ route('tambahUsaha') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('tambahUsaha') || request()->is('admin/businesses/create') ? 'bg-white/10 shadow-inner' : '' }}">
                                <i class="fas fa-plus-circle w-5 h-5"></i>
                                <span class="text-sm font-semibold">Tambah Usaha</span>
                            </a>
                            <a href="{{ route('daftarUsaha') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('daftarUsaha') || request()->is('admin/businesses') ? 'bg-white/10 shadow-inner' : '' }}">
                                <i class="fas fa-list w-5 h-5"></i>
                                <span class="text-sm font-semibold">Daftar Usaha</span>
                            </a>
                            <a href="{{ route('testimoni') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('testimoni') ? 'bg-white/10 shadow-inner' : '' }}">
                                <i class="fas fa-star w-5 h-5"></i>
                                <span class="text-sm font-semibold">Testimoni</span>
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('admin/users*') ? 'bg-white/10 shadow-inner' : '' }}">
                                <i class="fas fa-users w-5 h-5"></i>
                                <span class="text-sm font-semibold">Kelola User</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Konten Web</p>
                        <div class="space-y-1">
                            <a href="/admin/hero" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ navClass(['admin.hero', 'admin.hero.*', 'admin/hero'], $activeClass) }}">
                                <i class="fas fa-images w-5 h-5"></i>
                                <span class="text-sm font-semibold">Hero Slideshow</span>
                            </a>
                            <a href="/admin/about" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ navClass(['admin.about', 'admin.about.*', 'admin/about'], $activeClass) }}">
                                <i class="fas fa-info-circle w-5 h-5"></i>
                                <span class="text-sm font-semibold">Tentang Kami</span>
                            </a>
                            <a href="/admin/stats" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ navClass(['admin.stats', 'admin.stats.*', 'admin/stats'], $activeClass) }}">
                                <i class="fas fa-chart-bar w-5 h-5"></i>
                                <span class="text-sm font-semibold">Statistik</span>
                            </a>
                            <a href="/admin/contact" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ navClass(['admin.contact', 'admin.contact.*', 'admin/contact'], $activeClass) }}">
                                <i class="fas fa-address-book w-5 h-5"></i>
                                <span class="text-sm font-semibold">Kontak & Footer</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Sistem</p>
                        <div class="space-y-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 text-red-400 hover:text-red-300">
                                    <i class="fas fa-sign-out-alt w-5 h-5"></i>
                                    <span class="text-sm font-semibold">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Konten Utama --}}
        <div class="flex-1 p-4 lg:p-8 w-full">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-4 lg:p-8 border border-gray-100">
                <div class="mb-6">
                    <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Konten Web</p>
                    <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Hero & Konten Homepage</h2>
                    <p class="mt-2 text-sm text-gray-600">Kelola text hero, gambar slideshow, logo navbar, daftar usaha, dan testimoni</p>
                </div>

                <x-flash-message />

                {{-- ========== FORM TEXT HERO + LOGO ========== --}}
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <h3 class="font-bold text-lg text-[#4a1e2b] mb-4">
                        <i class="fas fa-font mr-2"></i> Text Hero & Logo Navbar
                    </h3>

                    <form action="{{ route('admin.hero.text') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- LOGO NAVBAR --}}
                        <div class="mt-6 p-4 border-2 border-yellow-200 bg-yellow-50 rounded-xl">
                            <h4 class="font-bold text-[#4a1e2b] mb-3">
                                <i class="fas fa-star mr-1"></i> Logo Navbar
                            </h4>

                            @php
                            $logoType = \App\Models\SiteContent::get('navbar_logo_type', 'text');
                            $logoImage = \App\Models\SiteContent::get('navbar_logo_image');
                            @endphp

                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-2">Tipe Logo</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="navbar_logo_type" value="text" {{ $logoType === 'text' ? 'checked' : '' }}
                                            onchange="toggleLogoInput()">
                                        <span class="text-sm">Text</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="navbar_logo_type" value="image" {{ $logoType === 'image' ? 'checked' : '' }}
                                            onchange="toggleLogoInput()">
                                        <span class="text-sm">Gambar</span>
                                    </label>
                                </div>
                            </div>

                            <div id="logo-text-input" class="mb-3" style="{{ $logoType === 'image' ? 'display:none' : '' }}">
                                <label class="block text-sm font-medium mb-2">Text Logo</label>
                                <input type="text" name="navbar_logo_text" value="{{ \App\Models\SiteContent::get('navbar_logo_text', 'RT 04') }}"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]"
                                    placeholder="Contoh: RT 04">
                            </div>

                            <div id="logo-image-input" style="{{ $logoType === 'text' ? 'display:none' : '' }}">
                                <label class="block text-sm font-medium mb-2">Upload Gambar Logo</label>

                                @if ($logoImage && file_exists(public_path($logoImage)))
                                <div class="mb-3 p-2 bg-white rounded-lg border border-gray-200 inline-block">
                                    <img src="{{ asset($logoImage) }}" class="h-12 object-contain" alt="Logo">
                                    <p class="text-xs text-gray-500 mt-1">Logo saat ini</p>
                                </div>
                                @endif

                                <input type="file" name="navbar_logo_image" accept="image/*"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ganti. Format PNG/SVG/JPG. Maks 1MB.</p>
                            </div>
                        </div>

                        {{-- TEXT HERO --}}
                        <div class="mb-4 mt-4">
                            <label class="block text-sm font-medium mb-2">Badge (text kecil di atas judul)</label>
                            <input type="text" name="hero_badge" value="{{ \App\Models\SiteContent::get('hero_badge', 'RT 04 Ngijo') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Judul Utama</label>
                            <input type="text" name="hero_title" value="{{ \App\Models\SiteContent::get('hero_title', 'Corner Bisnis<br>RT 04 Ngijo') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                            <p class="text-xs text-gray-500 mt-1">Pakai <code class="bg-gray-100 px-1 rounded">&lt;br&gt;</code> buat baris baru</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Subtitle</label>
                            <textarea name="hero_subtitle" rows="2"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">{{ \App\Models\SiteContent::get('hero_subtitle', 'Temukan berbagai usaha dan jasa yang dijalankan oleh warga RT 04 Ngijo.') }}</textarea>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="bg-[#4a1e2b] hover:bg-[#6b2d3f] text-white font-bold py-2 px-6 rounded-lg transition">
                                <i class="fas fa-save mr-2"></i> Simpan Text & Logo
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ⭐ ========== FORM TEXT DAFTAR USAHA ========== --}}
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <h3 class="font-bold text-lg text-[#4a1e2b] mb-4">
                        <i class="fas fa-store mr-2"></i> Text Section "Daftar Usaha"
                    </h3>

                    <form action="{{ route('admin.business.text') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Label Kecil (di atas judul)</label>
                            <input type="text" name="business_label"
                                value="{{ \App\Models\SiteContent::get('business_label', 'Explore') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Judul Section</label>
                            <input type="text" name="business_title"
                                value="{{ \App\Models\SiteContent::get('business_title', 'Usaha Warga RT 04') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Subtitle</label>
                            <textarea name="business_subtitle" rows="2"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">{{ \App\Models\SiteContent::get('business_subtitle', 'Jelajahi berbagai produk dan jasa yang dibuat langsung oleh warga sekitar.') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Text Tombol "Lihat Detail"</label>
                                <input type="text" name="business_view_detail"
                                    value="{{ \App\Models\SiteContent::get('business_view_detail', 'Lihat Detail →') }}"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Text Tombol "Lihat Semua Usaha"</label>
                                <input type="text" name="business_view_all_button"
                                    value="{{ \App\Models\SiteContent::get('business_view_all_button', 'Lihat Semua Usaha') }}"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Text Kalau Kosong (empty state)</label>
                            <input type="text" name="business_empty"
                                value="{{ \App\Models\SiteContent::get('business_empty', 'Belum ada usaha yang terdaftar.') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="bg-[#4a1e2b] hover:bg-[#6b2d3f] text-white font-bold py-2 px-6 rounded-lg transition">
                                <i class="fas fa-save mr-2"></i> Simpan Text Daftar Usaha
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ⭐ ========== FORM TEXT TESTIMONI ========== --}}
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <h3 class="font-bold text-lg text-[#4a1e2b] mb-4">
                        <i class="fas fa-star mr-2"></i> Text Section "Testimoni"
                    </h3>

                    <form action="{{ route('admin.testimonial.text') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Label Kecil (di atas judul)</label>
                            <input type="text" name="testimonial_label"
                                value="{{ \App\Models\SiteContent::get('testimonial_label', 'Testimonials') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Judul Section</label>
                            <input type="text" name="testimonial_title"
                                value="{{ \App\Models\SiteContent::get('testimonial_title', 'Apa Kata Mereka?') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Subtitle</label>
                            <textarea name="testimonial_subtitle" rows="2"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">{{ \App\Models\SiteContent::get('testimonial_subtitle', 'Pilih usaha lain yang mungkin cocok untuk kamu.') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Text Kalau Kosong (empty state)</label>
                            <input type="text" name="testimonial_empty"
                                value="{{ \App\Models\SiteContent::get('testimonial_empty', 'Belum ada testimoni.') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="bg-[#4a1e2b] hover:bg-[#6b2d3f] text-white font-bold py-2 px-6 rounded-lg transition">
                                <i class="fas fa-save mr-2"></i> Simpan Text Testimoni
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ========== UPLOAD GAMBAR ========== --}}
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <h3 class="font-bold text-lg text-[#4a1e2b] mb-4">
                        <i class="fas fa-cloud-upload-alt mr-2"></i> Upload Gambar Slideshow
                    </h3>

                    <form action="{{ route('admin.hero.add') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-3 p-4 bg-gradient-to-r from-[#4a1e2b] to-[#7A384D] rounded-xl">
                        @csrf
                        <input type="file" name="image" accept="image/*" required
                            class="flex-1 border-2 border-white/30 bg-white/10 text-white rounded-lg p-2 focus:outline-none focus:border-white file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-white file:text-[#4a1e2b] file:font-semibold file:cursor-pointer">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 text-[#4a1e2b] font-bold py-2 px-6 rounded-lg transition whitespace-nowrap">
                            <i class="fas fa-plus mr-1"></i> Tambah Gambar
                        </button>
                    </form>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Upload 1 per 1. Gambar otomatis ke-add di urutan terakhir.
                    </p>
                </div>

                {{-- ========== DAFTAR GAMBAR ========== --}}
                <div>
                    <h3 class="font-semibold mb-3">
                        <i class="fas fa-images mr-2"></i> Gambar Slideshow
                        <span class="text-sm font-normal text-gray-500">({{ count($heroImages) }} gambar)</span>
                    </h3>

                    @if (count($heroImages) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($heroImages as $index => $img)
                        <div class="relative group rounded-lg overflow-hidden border-2 border-gray-200 hover:border-[#4a1e2b] transition">
                            <img src="{{ asset($img) }}" class="w-full h-40 object-cover">
                            <div class="absolute top-2 left-2 bg-[#4a1e2b] text-white text-xs font-bold px-2 py-1 rounded">
                                #{{ $index + 1 }}
                            </div>
                            <form action="{{ route('admin.hero.remove') }}" method="POST"
                                onsubmit="return confirm('Hapus gambar ini?')"
                                class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                @csrf
                                <input type="hidden" name="index" value="{{ $index }}">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                        <i class="fas fa-image text-5xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Belum ada gambar hero</p>
                        <p class="text-sm text-gray-400 mt-1">Upload di atas buat mulai</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar) sidebar.classList.toggle('-translate-x-full');
            if (overlay) overlay.classList.toggle('hidden');
        }

        function toggleLogoInput() {
            const type = document.querySelector('input[name="navbar_logo_type"]:checked').value;
            const textInput = document.getElementById('logo-text-input');
            const imageInput = document.getElementById('logo-image-input');

            if (type === 'text') {
                textInput.style.display = 'block';
                imageInput.style.display = 'none';
            } else {
                textInput.style.display = 'none';
                imageInput.style.display = 'block';
            }
        }
    </script>

</body>

</html>