<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Testimoni - Corner Bisnis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .star-rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 0.25rem;
        }

        .star-rating-input input {
            display: none;
        }

        .star-rating-input label {
            cursor: pointer;
            font-size: 2rem;
            color: #d1d5db;
            transition: all 0.2s ease;
        }

        .star-rating-input label:hover,
        .star-rating-input label:hover~label,
        .star-rating-input input:checked~label {
            color: #fbbf24;
            transform: scale(1.1);
        }
    </style>
</head>

<body class="bg-[#F8F4F0]">

    {{-- Mobile Top Bar --}}
    <div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-gradient-to-r from-[#2B0F1A] to-[#4A1E2B] text-white px-4 py-3 flex items-center justify-between shadow-lg">
        <button class="text-2xl p-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="font-serif text-lg font-bold tracking-wide">RT 04 NGIJO</h1>
        <div class="w-10"></div>
    </div>

    {{-- Overlay --}}
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

        {{-- Konten Utama --}}
        <div class="flex-1 p-4 lg:p-8 w-full">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-4 lg:p-8 border border-gray-100">
                <div class="mb-6">
                    <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Manage</p>
                    <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Edit Testimoni</h2>
                </div>

                <form action="{{ route('testimoni.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Nama</label>
                        <input type="text" name="name" value="{{ $testimonial->name }}" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Konten</label>
                        <textarea name="content" rows="4" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">{{ $testimonial->content }}</textarea>
                    </div>

                    {{-- ⭐ INPUT BINTANG RATING --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2">Rating</label>
                        @php $currentRating = $testimonial->rating ?? 5; @endphp
                        <div class="star-rating-input">
                            <input type="radio" id="star5" name="rating" value="5" {{ $currentRating == 5 ? 'checked' : '' }}>
                            <label for="star5" title="5 bintang"><i class="fas fa-star"></i></label>

                            <input type="radio" id="star4" name="rating" value="4" {{ $currentRating == 4 ? 'checked' : '' }}>
                            <label for="star4" title="4 bintang"><i class="fas fa-star"></i></label>

                            <input type="radio" id="star3" name="rating" value="3" {{ $currentRating == 3 ? 'checked' : '' }}>
                            <label for="star3" title="3 bintang"><i class="fas fa-star"></i></label>

                            <input type="radio" id="star2" name="rating" value="2" {{ $currentRating == 2 ? 'checked' : '' }}>
                            <label for="star2" title="2 bintang"><i class="fas fa-star"></i></label>

                            <input type="radio" id="star1" name="rating" value="1" {{ $currentRating == 1 ? 'checked' : '' }}>
                            <label for="star1" title="1 bintang"><i class="fas fa-star"></i></label>
                        </div>
                        <p class="text-xs text-gray-500 mt-2" id="rating-text">{{ $currentRating }} dari 5 bintang</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Gambar Saat Ini</label>
                        @if ($testimonial->image)
                        <div class="mb-3">
                            <img src="{{ asset('images/' . $testimonial->image) }}" class="h-32 rounded-lg">
                        </div>
                        @else
                        <p class="text-sm text-gray-500 mb-2">Tidak ada gambar.</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Gambar Baru (Kosongkan jika tidak diganti)</label>
                        <input type="file" name="image" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 border-t border-gray-200 pt-6">
                        <a href="{{ route('testimoni') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition text-center">Batal</a>
                        <button type="submit" class="bg-[#4a1e2b] hover:bg-[#6b2d3f] text-white font-bold py-2 px-6 rounded-lg transition">
                            <i class="fas fa-save mr-2"></i> Update
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

        // ⭐ Update text rating saat bintang diklik
        document.querySelectorAll('input[name="rating"]').forEach(input => {
            input.addEventListener('change', function() {
                document.getElementById('rating-text').textContent = `${this.value} dari 5 bintang`;
            });
        });
    </script>

</body>

</html>