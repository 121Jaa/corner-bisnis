<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik Usaha - Corner Bisnis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F8F4F0]">

    {{-- Mobile Top Bar --}}
    <div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-gradient-to-r from-[#1a3a2b] to-[#2b5a3f] text-white px-4 py-3 flex items-center justify-between shadow-lg">
        <button class="text-2xl p-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="font-serif text-lg font-bold tracking-wide">RT 04 NGIJO</h1>
        <div class="w-10"></div>
    </div>

    {{-- Overlay --}}
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <div class="min-h-screen flex pt-14 lg:pt-0">

        @include('partials.sidebar-user')

        {{-- Konten Utama --}}
        <div class="flex-1 p-4 lg:p-8 w-full">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-4 lg:p-8 border border-gray-100">

                {{-- Welcome --}}
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
                    <div>
                        <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Selamat Datang</p>
                        <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#1a3a2b]">
                            Halo, {{ auth()->user()->display_name ?? auth()->user()->name }}! 
                        </h2>
                        <p class="mt-2 text-gray-600">Kelola usaha kamu dari sini</p>
                    </div>
                    <div class="bg-gradient-to-r from-[#1a3a2b] to-[#2b5a3f] rounded-full px-4 lg:px-6 py-2 text-white text-xs lg:text-sm font-bold">
                        {{ now()->format('d M Y') }}
                    </div>
                </div>

                <x-flash-message />

                <x-flash-message />

                {{-- Statistik --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-gradient-to-br from-[#1a3a2b] to-[#2b5a3f] rounded-xl p-5 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl lg:text-4xl font-bold">{{ $totalBusinesses }}</p>
                                <p class="mt-1 text-xs lg:text-sm font-semibold uppercase tracking-wider opacity-80">Usaha Saya</p>
                            </div>
                            <i class="fas fa-store text-3xl opacity-30"></i>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-[#D4AF37] to-[#E6C86D] rounded-xl p-5 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl lg:text-4xl font-bold">{{ $totalCategories }}</p>
                                <p class="mt-1 text-xs lg:text-sm font-semibold uppercase tracking-wider opacity-80">Kategori</p>
                            </div>
                            <i class="fas fa-tags text-3xl opacity-30"></i>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl p-5 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl lg:text-4xl font-bold">24/7</p>
                                <p class="mt-1 text-xs lg:text-sm font-semibold uppercase tracking-wider opacity-80">Online</p>
                            </div>
                            <i class="fas fa-globe text-3xl opacity-30"></i>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-green-600 to-green-400 rounded-xl p-5 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-3xl lg:text-4xl font-bold">100%</p>
                                <p class="mt-1 text-xs lg:text-sm font-semibold uppercase tracking-wider opacity-80">Gratis</p>
                            </div>
                            <i class="fas fa-check-circle text-3xl opacity-30"></i>
                        </div>
                    </div>
                </div>

                {{-- Usaha Saya --}}
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-serif text-2xl font-bold text-[#1a3a2b]">Usaha Saya</h3>
                    <a href="{{ route('user.businesses.create') }}" class="bg-gradient-to-r from-[#1a3a2b] to-[#2b5a3f] rounded-full px-5 py-2 text-white text-sm font-bold hover:opacity-90 transition">
                        <i class="fas fa-plus mr-1"></i> Tambah Usaha
                    </a>
                </div>

                @if ($businesses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($businesses as $business)
                    <div class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm hover:shadow-lg transition">
                        <img src="{{ asset('images/' . $business->image) }}" alt="{{ $business->name }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-[#1a3a2b] text-white mb-2">
                                {{ $business->category->name ?? '-' }}
                            </span>
                            <h4 class="font-bold text-lg text-gray-900">{{ $business->type ?? $business->name }}</h4>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $business->description }}</p>
                            <div class="flex gap-2 mt-4">
                                <a href="{{ route('user.businesses.edit', $business->id) }}" class="flex-1 text-center bg-indigo-500 hover:bg-indigo-600 text-white py-2 rounded-lg text-sm font-semibold transition">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('user.businesses.destroy', $business->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg text-sm font-semibold transition" onclick="return confirm('Yakin hapus?')">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-16 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                    <i class="fas fa-store text-5xl text-gray-300 mb-4"></i>
                    <p class="text-lg text-gray-500 font-semibold">Belum ada usaha</p>
                    <p class="text-sm text-gray-400 mt-1">Yuk mulai tambahkan usaha kamu!</p>
                    <a href="{{ route('user.businesses.create') }}" class="inline-block mt-4 bg-[#1a3a2b] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#2b5a3f] transition">
                        <i class="fas fa-plus mr-1"></i> Tambah Usaha Pertama
                    </a>
                </div>
                @endif
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