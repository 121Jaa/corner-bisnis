{{-- Sidebar User --}}
<div id="sidebar" class="fixed lg:static inset-y-0 left-0 w-72 bg-gradient-to-b from-[#1a3a2b] to-[#2b5a3f] text-white flex flex-col shadow-2xl z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
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
                    <p class="text-xs uppercase tracking-[0.3em] opacity-60">Pemilik Usaha</p>
                </div>
            </div>
            <button class="lg:hidden text-2xl p-2" onclick="toggleSidebar()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- ⭐ USER INFO --}}
        <div class="mb-6 p-3 rounded-xl bg-white/5 border border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->display_name ?? auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">
                        {{ auth()->user()->display_name ?? auth()->user()->name }}
                    </p>
                    <p class="text-[10px] font-semibold uppercase tracking-wider bg-blue-500/20 text-blue-300 border-blue-500/30 inline-block px-2 py-0.5 rounded-full border mt-1">
                        Pemilik Usaha
                    </p>
                </div>
            </div>
        </div>

        {{-- Menu --}}
        <div class="space-y-6">
            <div>
                <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Menu Utama</p>
                <div class="space-y-1">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 @active('user.dashboard')">
                        <i class="fas fa-chart-pie w-5 h-5"></i>
                        <span class="text-sm font-semibold">Dashboard</span>
                    </a>
                    <a href="{{ route('user.businesses.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 @active(['user.businesses.index', 'user.businesses.edit'])">
                        <i class="fas fa-store w-5 h-5"></i>
                        <span class="text-sm font-semibold">Usaha Saya</span>
                    </a>
                    <a href="{{ route('user.businesses.create') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 @active('user.businesses.create')">
                        <i class="fas fa-plus-circle w-5 h-5"></i>
                        <span class="text-sm font-semibold">Tambah Usaha</span>
                    </a>
                </div>
            </div>

            <div>
                <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Kunjungi</p>
                <div class="space-y-1">
                    <a href="/" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                        <i class="fas fa-globe w-5 h-5"></i>
                        <span class="text-sm font-semibold">Halaman Utama</span>
                    </a>
                    <a href="{{ route('all-businesses') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                        <i class="fas fa-search w-5 h-5"></i>
                        <span class="text-sm font-semibold">Semua Usaha</span>
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