<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Admin</title>
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

                {{-- Header --}}
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

                {{-- USER INFO --}}
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

                {{-- HELPER FUNCTION --}}
                @php
                $activeClass = 'bg-white/10 shadow-inner';
                $normalClass = '';

                if (!function_exists('navClass')) {
                function navClass($patterns, $activeClass) {
                foreach ((array) $patterns as $pattern) {
                if (request()->routeIs($pattern) || request()->is($pattern)) {
                return $activeClass;
                }
                }
                return '';
                }
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

        {{-- Konten --}}
        <div class="flex-1 p-4 lg:p-8 w-full">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-4 lg:p-8 border border-gray-100">
                <div class="mb-6">
                    <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Konten Web</p>
                    <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Tentang Kami</h2>
                    <p class="mt-2 text-sm text-gray-600">Kelola konten & style section "Our Story"</p>
                </div>

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                        <p class="font-bold mb-2"><i class="fas fa-exclamation-circle mr-2"></i>Ada yang salah:</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <x-flash-message />

                <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- ============ LABEL SECTION ============ --}}
                    <div class="mb-6 p-4 bg-orange-50 rounded-xl border-2 border-orange-200">
                        <p class="text-sm font-bold text-[#4a1e2b] mb-3">
                            <i class="fas fa-tag mr-1"></i> Label Section
                        </p>

                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-2">Text Label</label>
                            <input type="text" name="about_label" value="{{ \App\Models\SiteContent::get('about_label', 'Design Philosophy') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b] bg-white">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">
                                    Font Size: <span id="d-about-label" class="font-bold text-[#4a1e2b]">{{ \App\Models\SiteContent::get('about_label_size', 14) }}px</span>
                                </label>
                                <input type="range" name="about_label_size" min="8" max="40"
                                    value="{{ \App\Models\SiteContent::get('about_label_size', 14) }}"
                                    oninput="document.getElementById('d-about-label').textContent = this.value + 'px'"
                                    class="w-full accent-[#4a1e2b]">
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>8px</span><span>14px</span><span>40px</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Warna</label>
                                <div class="flex gap-3 items-center">
                                    <input type="color" name="about_label_color" value="{{ \App\Models\SiteContent::get('about_label_color', '#eab308') }}"
                                        oninput="document.getElementById('c-about-label').value = this.value"
                                        class="w-16 h-10 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                    <input type="text" id="c-about-label" value="{{ \App\Models\SiteContent::get('about_label_color', '#eab308') }}"
                                        oninput="document.querySelector('input[name=about_label_color]').value = this.value"
                                        class="flex-1 border-2 border-gray-300 rounded-lg p-2 font-mono text-sm bg-white">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ============ JUDUL ============ --}}
                    <div class="mb-6 p-4 bg-blue-50 rounded-xl border-2 border-blue-200">
                        <p class="text-sm font-bold text-[#4a1e2b] mb-3">
                            <i class="fas fa-heading mr-1"></i> Judul
                        </p>

                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-2">Text Judul</label>
                            <input type="text" name="about_title" value="{{ \App\Models\SiteContent::get('about_title', 'Our Story') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b] bg-white">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">
                                    Font Size: <span id="d-about-title" class="font-bold text-[#4a1e2b]">{{ \App\Models\SiteContent::get('about_title_size', 48) }}px</span>
                                </label>
                                <input type="range" name="about_title_size" min="20" max="120"
                                    value="{{ \App\Models\SiteContent::get('about_title_size', 48) }}"
                                    oninput="document.getElementById('d-about-title').textContent = this.value + 'px'"
                                    class="w-full accent-[#4a1e2b]">
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>20px</span><span>48px</span><span>120px</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Warna</label>
                                <div class="flex gap-3 items-center">
                                    <input type="color" name="about_title_color" value="{{ \App\Models\SiteContent::get('about_title_color', '#ffffff') }}"
                                        oninput="document.getElementById('c-about-title').value = this.value"
                                        class="w-16 h-10 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                    <input type="text" id="c-about-title" value="{{ \App\Models\SiteContent::get('about_title_color', '#ffffff') }}"
                                        oninput="document.querySelector('input[name=about_title_color]').value = this.value"
                                        class="flex-1 border-2 border-gray-300 rounded-lg p-2 font-mono text-sm bg-white">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ============ SUBTITLE ============ --}}
                    <div class="mb-6 p-4 bg-yellow-50 rounded-xl border-2 border-yellow-200">
                        <p class="text-sm font-bold text-[#4a1e2b] mb-3">
                            <i class="fas fa-align-left mr-1"></i> Subtitle (italic)
                        </p>

                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-2">Text Subtitle</label>
                            <input type="text" name="about_subtitle" value="{{ \App\Models\SiteContent::get('about_subtitle', 'Contemporary Design. Crafted by Culture.') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 bg-white">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">
                                    Font Size: <span id="d-about-sub" class="font-bold text-[#4a1e2b]">{{ \App\Models\SiteContent::get('about_subtitle_size', 20) }}px</span>
                                </label>
                                <input type="range" name="about_subtitle_size" min="10" max="60"
                                    value="{{ \App\Models\SiteContent::get('about_subtitle_size', 20) }}"
                                    oninput="document.getElementById('d-about-sub').textContent = this.value + 'px'"
                                    class="w-full accent-[#4a1e2b]">
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>10px</span><span>20px</span><span>60px</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Warna</label>
                                <div class="flex gap-3 items-center">
                                    <input type="color" name="about_subtitle_color" value="{{ \App\Models\SiteContent::get('about_subtitle_color', '#fef08a') }}"
                                        oninput="document.getElementById('c-about-sub').value = this.value"
                                        class="w-16 h-10 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                    <input type="text" id="c-about-sub" value="{{ \App\Models\SiteContent::get('about_subtitle_color', '#fef08a') }}"
                                        oninput="document.querySelector('input[name=about_subtitle_color]').value = this.value"
                                        class="flex-1 border-2 border-gray-300 rounded-lg p-2 font-mono text-sm bg-white">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ============ DESKRIPSI ============ --}}
                    <div class="mb-6 p-4 bg-green-50 rounded-xl border-2 border-green-200">
                        <p class="text-sm font-bold text-[#4a1e2b] mb-3">
                            <i class="fas fa-file-alt mr-1"></i> Deskripsi
                        </p>

                        <div class="mb-3">
                            <label class="block text-sm font-medium mb-2">Paragraf 1</label>
                            <textarea name="about_desc_1" rows="3" class="w-full border-2 border-gray-300 rounded-lg p-2 bg-white">{{ \App\Models\SiteContent::get('about_desc_1', 'Setiap ruang di Corner Bisnis terinspirasi dari kerajinan tangan dan semangat gotong royong warga RT 04.') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Paragraf 2</label>
                            <textarea name="about_desc_2" rows="3" class="w-full border-2 border-gray-300 rounded-lg p-2 bg-white">{{ \App\Models\SiteContent::get('about_desc_2', 'Dinding maroon yang hangat, sentuhan kuning marigold, dan aksen kayu kenari berpadu menciptakan suasana yang terasa modern.') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">
                                    Font Size: <span id="d-about-desc" class="font-bold text-[#4a1e2b]">{{ \App\Models\SiteContent::get('about_desc_size', 18) }}px</span>
                                </label>
                                <input type="range" name="about_desc_size" min="10" max="40"
                                    value="{{ \App\Models\SiteContent::get('about_desc_size', 18) }}"
                                    oninput="document.getElementById('d-about-desc').textContent = this.value + 'px'"
                                    class="w-full accent-[#4a1e2b]">
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>10px</span><span>18px</span><span>40px</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Warna</label>
                                <div class="flex gap-3 items-center">
                                    <input type="color" name="about_desc_color" value="{{ \App\Models\SiteContent::get('about_desc_color', '#d1d5db') }}"
                                        oninput="document.getElementById('c-about-desc').value = this.value"
                                        class="w-16 h-10 border-2 border-gray-300 rounded-lg cursor-pointer bg-xwhite">
                                    <input type="text" id="c-about-desc" value="{{ \App\Models\SiteContent::get('about_desc_color', '#d1d5db') }}"
                                        oninput="document.querySelector('input[name=about_desc_color]').value = this.value"
                                        class="flex-1 border-2 border-gray-300 rounded-lg p-2 font-mono text-sm bg-white">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ============ GAMBAR ============ --}}
                    <div class="mb-6 p-4 bg-purple-50 rounded-xl border-2 border-purple-200">
                        <p class="text-sm font-bold text-[#4a1e2b] mb-3">
                            <i class="fas fa-image mr-1"></i> Gambar Section
                        </p>

                        @if (\App\Models\SiteContent::get('about_image'))
                        <div class="mb-3">
                            <img src="{{ asset(\App\Models\SiteContent::get('about_image')) }}" class="h-40 rounded-lg shadow">
                        </div>
                        @endif

                        <input type="file" name="about_image" accept="image/jpeg,image/jpg,image/png,image/webp,image/avif"
                            class="auto-compress w-full border-2 border-gray-300 rounded-lg p-2 bg-white">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak diganti. Format JPG/PNG/WebP/AVIF. Maks 10MB.</p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#4a1e2b] hover:bg-[#6b2d3f] text-white font-bold py-3 px-8 rounded-lg transition">
                            <i class="fas fa-save mr-2"></i> Simpan Tentang Kami
                        </button>
                    </div>
                </form>
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
    </script>

</body>

</html>