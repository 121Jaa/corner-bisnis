<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik - Admin</title>
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

        <div class="flex-1 p-4 lg:p-8 w-full">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-4 lg:p-8 border border-gray-100">
                <div class="mb-6">
                    <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Konten Web</p>
                    <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Statistik</h2>
                    <p class="mt-2 text-sm text-gray-600">Kelola angka, label, font size, dan warna statistik di halaman utama</p>
                </div>

                <x-flash-message />

                <form action="{{ route('admin.stats.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- ============ AKSES ONLINE ============ --}}
                        <div class="border-2 border-gray-200 rounded-xl p-4 bg-gray-50">
                            <h3 class="font-bold mb-3 text-[#4a1e2b]">
                                <i class="fas fa-clock mr-1"></i> Akses Online
                            </h3>

                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">Nilai</label>
                                <input type="text" name="stat_access" value="{{ \App\Models\SiteContent::get('stat_access', '24/7') }}"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b] bg-white">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">Label</label>
                                <input type="text" name="stat_access_label" value="{{ \App\Models\SiteContent::get('stat_access_label', 'Akses Online') }}"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b] bg-white">
                            </div>

                            <div class="grid grid-cols-2 gap-3 pt-3 border-t border-gray-300">
                                <div>
                                    <label class="block text-xs font-medium mb-1">
                                        Nilai Size: <span id="a-val-size" class="font-bold">{{ \App\Models\SiteContent::get('stat_access_size', 36) }}px</span>
                                    </label>
                                    <input type="range" name="stat_access_size" min="20" max="100"
                                        value="{{ \App\Models\SiteContent::get('stat_access_size', 36) }}"
                                        oninput="document.getElementById('a-val-size').textContent = this.value + 'px'"
                                        class="w-full accent-[#4a1e2b]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">Nilai Warna</label>
                                    <input type="color" name="stat_access_color"
                                        value="{{ \App\Models\SiteContent::get('stat_access_color', '#4a1e2b') }}"
                                        class="w-full h-9 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">
                                        Label Size: <span id="a-lbl-size" class="font-bold">{{ \App\Models\SiteContent::get('stat_access_label_size', 14) }}px</span>
                                    </label>
                                    <input type="range" name="stat_access_label_size" min="8" max="40"
                                        value="{{ \App\Models\SiteContent::get('stat_access_label_size', 14) }}"
                                        oninput="document.getElementById('a-lbl-size').textContent = this.value + 'px'"
                                        class="w-full accent-[#4a1e2b]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">Label Warna</label>
                                    <input type="color" name="stat_access_label_color"
                                        value="{{ \App\Models\SiteContent::get('stat_access_label_color', '#6b7280') }}"
                                        class="w-full h-9 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                </div>
                            </div>
                        </div>

                        {{-- ============ WARGA TERBANTU ============ --}}
                        <div class="border-2 border-gray-200 rounded-xl p-4 bg-gray-50">
                            <h3 class="font-bold mb-3 text-[#4a1e2b]">
                                <i class="fas fa-hands-helping mr-1"></i> Warga Terbantu
                            </h3>

                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">Nilai</label>
                                <input type="text" name="stat_helped" value="{{ \App\Models\SiteContent::get('stat_helped', '100%') }}"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b] bg-white">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">Label</label>
                                <input type="text" name="stat_helped_label" value="{{ \App\Models\SiteContent::get('stat_helped_label', 'Warga Terbantu') }}"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b] bg-white">
                            </div>

                            <div class="grid grid-cols-2 gap-3 pt-3 border-t border-gray-300">
                                <div>
                                    <label class="block text-xs font-medium mb-1">
                                        Nilai Size: <span id="h-val-size" class="font-bold">{{ \App\Models\SiteContent::get('stat_helped_size', 36) }}px</span>
                                    </label>
                                    <input type="range" name="stat_helped_size" min="20" max="100"
                                        value="{{ \App\Models\SiteContent::get('stat_helped_size', 36) }}"
                                        oninput="document.getElementById('h-val-size').textContent = this.value + 'px'"
                                        class="w-full accent-[#4a1e2b]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">Nilai Warna</label>
                                    <input type="color" name="stat_helped_color"
                                        value="{{ \App\Models\SiteContent::get('stat_helped_color', '#4a1e2b') }}"
                                        class="w-full h-9 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">
                                        Label Size: <span id="h-lbl-size" class="font-bold">{{ \App\Models\SiteContent::get('stat_helped_label_size', 14) }}px</span>
                                    </label>
                                    <input type="range" name="stat_helped_label_size" min="8" max="40"
                                        value="{{ \App\Models\SiteContent::get('stat_helped_label_size', 14) }}"
                                        oninput="document.getElementById('h-lbl-size').textContent = this.value + 'px'"
                                        class="w-full accent-[#4a1e2b]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">Label Warna</label>
                                    <input type="color" name="stat_helped_label_color"
                                        value="{{ \App\Models\SiteContent::get('stat_helped_label_color', '#6b7280') }}"
                                        class="w-full h-9 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                </div>
                            </div>
                        </div>

                        {{-- ============ USAHA TERDAFTAR ============ --}}
                        <div class="border-2 border-gray-200 rounded-xl p-4 bg-gray-50">
                            <h3 class="font-bold mb-3 text-[#4a1e2b]">
                                <i class="fas fa-store mr-1"></i> Usaha Terdaftar
                            </h3>
                            <p class="text-xs text-gray-500 mb-3">
                                <i class="fas fa-info-circle mr-1"></i>
                                Nilai otomatis dari jumlah usaha di database
                            </p>

                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">Label</label>
                                <input type="text" name="stat_business_label" value="{{ \App\Models\SiteContent::get('stat_business_label', 'Usaha Terdaftar') }}"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b] bg-white">
                            </div>

                            <div class="grid grid-cols-2 gap-3 pt-3 border-t border-gray-300">
                                <div>
                                    <label class="block text-xs font-medium mb-1">
                                        Nilai Size: <span id="b-val-size" class="font-bold">{{ \App\Models\SiteContent::get('stat_business_size', 36) }}px</span>
                                    </label>
                                    <input type="range" name="stat_business_size" min="20" max="100"
                                        value="{{ \App\Models\SiteContent::get('stat_business_size', 36) }}"
                                        oninput="document.getElementById('b-val-size').textContent = this.value + 'px'"
                                        class="w-full accent-[#4a1e2b]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">Nilai Warna</label>
                                    <input type="color" name="stat_business_color"
                                        value="{{ \App\Models\SiteContent::get('stat_business_color', '#4a1e2b') }}"
                                        class="w-full h-9 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">
                                        Label Size: <span id="b-lbl-size" class="font-bold">{{ \App\Models\SiteContent::get('stat_business_label_size', 14) }}px</span>
                                    </label>
                                    <input type="range" name="stat_business_label_size" min="8" max="40"
                                        value="{{ \App\Models\SiteContent::get('stat_business_label_size', 14) }}"
                                        oninput="document.getElementById('b-lbl-size').textContent = this.value + 'px'"
                                        class="w-full accent-[#4a1e2b]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">Label Warna</label>
                                    <input type="color" name="stat_business_label_color"
                                        value="{{ \App\Models\SiteContent::get('stat_business_label_color', '#6b7280') }}"
                                        class="w-full h-9 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                </div>
                            </div>
                        </div>

                        {{-- ============ KATEGORI USAHA ============ --}}
                        <div class="border-2 border-gray-200 rounded-xl p-4 bg-gray-50">
                            <h3 class="font-bold mb-3 text-[#4a1e2b]">
                                <i class="fas fa-folder mr-1"></i> Kategori Usaha
                            </h3>
                            <p class="text-xs text-gray-500 mb-3">
                                <i class="fas fa-info-circle mr-1"></i>
                                Nilai otomatis dari jumlah kategori di database
                            </p>

                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">Label</label>
                                <input type="text" name="stat_category_label" value="{{ \App\Models\SiteContent::get('stat_category_label', 'Kategori Usaha') }}"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b] bg-white">
                            </div>

                            <div class="grid grid-cols-2 gap-3 pt-3 border-t border-gray-300">
                                <div>
                                    <label class="block text-xs font-medium mb-1">
                                        Nilai Size: <span id="c-val-size" class="font-bold">{{ \App\Models\SiteContent::get('stat_category_size', 36) }}px</span>
                                    </label>
                                    <input type="range" name="stat_category_size" min="20" max="100"
                                        value="{{ \App\Models\SiteContent::get('stat_category_size', 36) }}"
                                        oninput="document.getElementById('c-val-size').textContent = this.value + 'px'"
                                        class="w-full accent-[#4a1e2b]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">Nilai Warna</label>
                                    <input type="color" name="stat_category_color"
                                        value="{{ \App\Models\SiteContent::get('stat_category_color', '#4a1e2b') }}"
                                        class="w-full h-9 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">
                                        Label Size: <span id="c-lbl-size" class="font-bold">{{ \App\Models\SiteContent::get('stat_category_label_size', 14) }}px</span>
                                    </label>
                                    <input type="range" name="stat_category_label_size" min="8" max="40"
                                        value="{{ \App\Models\SiteContent::get('stat_category_label_size', 14) }}"
                                        oninput="document.getElementById('c-lbl-size').textContent = this.value + 'px'"
                                        class="w-full accent-[#4a1e2b]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium mb-1">Label Warna</label>
                                    <input type="color" name="stat_category_label_color"
                                        value="{{ \App\Models\SiteContent::get('stat_category_label_color', '#6b7280') }}"
                                        class="w-full h-9 border-2 border-gray-300 rounded-lg cursor-pointer bg-white">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end mt-6 border-t pt-6">
                        <button type="submit" class="bg-[#4a1e2b] hover:bg-[#6b2d3f] text-white font-bold py-2 px-6 rounded-lg transition">
                            <i class="fas fa-save mr-2"></i> Simpan Semua
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