<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak & Footer - Admin</title>
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

                {{-- ⭐ USER INFO --}}
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

                {{-- ⭐ HELPER FUNCTION UNTUK ACTIVE STATE --}}
                @php
                $activeClass = 'bg-white/10 shadow-inner';
                $normalClass = '';

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
                            {{-- ⭐ MENU USER BARU --}}
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
                    <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Kontak & Footer</h2>
                    <p class="mt-2 text-sm text-gray-600">Kelola kontak dan footer di halaman utama</p>
                </div>

                <x-flash-message />

                <form action="{{ route('admin.contact.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Alamat</label>
                            <input type="text" name="contact_address" value="{{ \App\Models\SiteContent::get('contact_address', 'RT 04 Ngijo, Karangploso, Malang') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Phone</label>
                            <input type="text" name="contact_phone" value="{{ \App\Models\SiteContent::get('contact_phone', '+62 812-3456-7890') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" name="contact_email" value="{{ \App\Models\SiteContent::get('contact_email', 'cornerbisnis@gmail.com') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">WhatsApp (angka saja, contoh: 6281234567890)</label>
                            <input type="text" name="contact_whatsapp" value="{{ \App\Models\SiteContent::get('contact_whatsapp', '6281234567890') }}"
                                class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                        </div>
                    </div>

                    <hr class="my-6">

                    <h3 class="font-bold text-lg mb-4">CTA Section</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">CTA Title</label>
                        <input type="text" name="cta_title" value="{{ \App\Models\SiteContent::get('cta_title', 'Punya Usaha di RT 04?') }}"
                            class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">CTA Description</label>
                        <textarea name="cta_desc" rows="2" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">{{ \App\Models\SiteContent::get('cta_desc', 'Daftarkan usaha kamu sekarang dan biar lebih banyak warga yang tahu!') }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#4a1e2b] hover:bg-[#6b2d3f] text-white font-bold py-2 px-6 rounded-lg transition">
                            <i class="fas fa-save mr-2"></i> Simpan
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