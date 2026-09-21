<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Corner Bisnis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F8F4F0]">

    <!-- Mobile Top Bar -->
    <div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-gradient-to-r from-[#2B0F1A] to-[#4A1E2B] text-white px-4 py-3 flex items-center justify-between shadow-lg">
        <button class="text-2xl p-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="font-serif text-lg font-bold tracking-wide">RT 04 NGIJO</h1>
        <div class="w-10"></div>
    </div>

    <!-- Overlay -->
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

        <!-- Konten Utama -->
        <div class="flex-1 p-4 lg:p-8 w-full">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-4 lg:p-8 border border-gray-100">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Welcome Back</p>
                        <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Dashboard Admin</h2>
                    </div>
                    <div class="bg-gradient-to-r from-[#4a1e2b] to-[#7A384D] rounded-full px-4 lg:px-6 py-2 text-white text-xs lg:text-sm font-bold">
                        {{ now()->format('d M Y') }}
                    </div>
                </div>

                <x-flash-message />

                <x-flash-message />

                <!-- Kartu Statistik -->
                <div class="mt-6 lg:mt-8 grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6">
                    <div class="bg-gradient-to-r from-[#4a1e2b] to-[#7A384D] rounded-xl lg:rounded-2xl p-4 lg:p-6 text-white relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 10px 10px;"></div>
                        <div class="relative">
                            <p class="text-2xl lg:text-4xl font-bold">10</p>
                            <p class="mt-1 lg:mt-2 text-xs lg:text-sm font-semibold uppercase tracking-wider opacity-80">Usaha</p>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-[#D4AF37] to-[#E6C86D] rounded-xl lg:rounded-2xl p-4 lg:p-6 text-white relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 10px 10px;"></div>
                        <div class="relative">
                            <p class="text-2xl lg:text-4xl font-bold">{{ $totalCategories }}</p>
                            <p class="mt-1 lg:mt-2 text-xs lg:text-sm font-semibold uppercase tracking-wider opacity-80">Kategori</p>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-green-600 to-green-400 rounded-xl lg:rounded-2xl p-4 lg:p-6 text-white relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 10px 10px;"></div>
                        <div class="relative">
                            <p class="text-2xl lg:text-4xl font-bold">24/7</p>
                            <p class="mt-1 lg:mt-2 text-xs lg:text-sm font-semibold uppercase tracking-wider opacity-80">Akses</p>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-xl lg:rounded-2xl p-4 lg:p-6 text-white relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 10px 10px;"></div>
                        <div class="relative">
                            <p class="text-2xl lg:text-4xl font-bold">100%</p>
                            <p class="mt-1 lg:mt-2 text-xs lg:text-sm font-semibold uppercase tracking-wider opacity-80">Terbantu</p>
                        </div>
                    </div>
                </div>

                <!-- Grafik -->
                <div class="mt-6 lg:mt-10 grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
                    <div class="bg-[#F8F4F0] rounded-2xl p-4 lg:p-6">
                        <h3 class="font-serif text-base lg:text-xl font-bold mb-4 lg:mb-6">Jumlah Usaha per Kategori</h3>
                        <div class="h-64 lg:h-auto">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-[#F8F4F0] rounded-2xl p-4 lg:p-6">
                        <h3 class="font-serif text-base lg:text-xl font-bold mb-4 lg:mb-6">Usaha Terbaru</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs lg:text-sm text-left">
                                <thead>
                                    <tr>
                                        <th class="pb-2 lg:pb-4 border-b border-gray-200">Kategori</th>
                                        <th class="pb-2 lg:pb-4 border-b border-gray-200">Nama Usaha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($businesses->take(5) as $business)
                                    <tr>
                                        <td class="py-2 lg:py-3">{{ $business->category->name ?? '-' }}</td>
                                        <td class="py-2 lg:py-3">{{ $business->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="mt-6 lg:mt-10 bg-[#F8F4F0] rounded-2xl p-4 lg:p-6">
                    <h3 class="font-serif text-base lg:text-xl font-bold mb-4 lg:mb-6">Proporsi Usaha</h3>
                    <div class="max-w-md mx-auto">
                        <canvas id="categoryPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.toggle('hidden');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($categoryNames),
                datasets: [{
                    label: 'Jumlah Usaha',
                    data: @json($categoryCounts),
                    backgroundColor: ['#4a1e2b', '#D4AF37', '#FF6F61', '#2196F3', '#4CAF50'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const pieCtx = document.getElementById('categoryPieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: @json($categoryNames),
                datasets: [{
                    data: @json($categoryCounts),
                    backgroundColor: ['#4a1e2b', '#D4AF37', '#FF6F61', '#2196F3', '#4CAF50'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

</body>

</html>