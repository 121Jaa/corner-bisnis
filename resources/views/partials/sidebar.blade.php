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

{{-- Sidebar --}}
<div id="sidebar" class="fixed lg:static inset-y-0 left-0 w-72 bg-gradient-to-b from-[#2B0F1A] to-[#4A1E2B] text-white flex flex-col shadow-2xl z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
    <div class="relative z-10 p-6 overflow-y-auto h-full">
        <div class="flex items-center justify-between gap-3 pb-8">
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

        <div class="space-y-2">
            <a href="/" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                <i class="fas fa-home w-5 h-5"></i>
                <span class="text-sm font-semibold">Home</span>
            </a>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('dashboard') ? 'bg-white/10 shadow-inner' : '' }}">
                <i class="fas fa-chart-pie w-5 h-5"></i>
                <span class="text-sm font-semibold">Dashboard</span>
            </a>
            <a href="{{ route('tambahUsaha') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('tambahUsaha') || request()->is('admin/businesses/create') ? 'bg-white/10 shadow-inner' : '' }}">
                <i class="fas fa-plus-circle w-5 h-5"></i>
                <span class="text-sm font-semibold">Tambah Usaha</span>
            </a>
            <a href="{{ route('daftarUsaha') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('daftarUsaha') || request()->is('admin/businesses') ? 'bg-white/10 shadow-inner' : '' }}">
                <i class="fas fa-list w-5 h-5"></i>
                <span class="text-sm font-semibold">Daftar Usaha</span>
            </a>
            <a href="{{ route('testimoni') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('testimoni') ? 'bg-white/10 shadow-inner' : '' }}">
                <i class="fas fa-star w-5 h-5"></i>
                <span class="text-sm font-semibold">Testimoni</span>
            </a>
            <a href="/logout" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                <i class="fas fa-sign-out-alt w-5 h-5"></i>
                <span class="text-sm font-semibold">Logout</span>
            </a>
        </div>
    </div>
</div>

{{-- Script Sidebar --}}
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (sidebar) sidebar.classList.toggle('-translate-x-full');
        if (overlay) overlay.classList.toggle('hidden');
    }
</script>