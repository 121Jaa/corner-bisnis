<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <div class="min-h-screen flex pt-14 lg:pt-0">

        {{-- Sidebar Admin --}}
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

                <div class="space-y-6">
                    <div>
                        <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Main</p>
                        <div class="space-y-1">
                            <a href="/" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                                <i class="fas fa-home w-5 h-5"></i>
                                <span class="text-sm font-semibold">Home</span>
                            </a>
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('dashboard') ? 'bg-white/10 shadow-inner' : '' }}">
                                <i class="fas fa-chart-pie w-5 h-5"></i>
                                <span class="text-sm font-semibold">Dashboard</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Kelola Data</p>
                        <div class="space-y-1">
                            <a href="{{ route('tambahUsaha') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('tambahUsaha') ? 'bg-white/10 shadow-inner' : '' }}">
                                <i class="fas fa-plus-circle w-5 h-5"></i>
                                <span class="text-sm font-semibold">Tambah Usaha</span>
                            </a>
                            <a href="{{ route('daftarUsaha') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('daftarUsaha') ? 'bg-white/10 shadow-inner' : '' }}">
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
                            <a href="/admin/hero" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('admin/hero') ? 'bg-white/10 shadow-inner' : '' }}">
                                <i class="fas fa-images w-5 h-5"></i>
                                <span class="text-sm font-semibold">Hero Slideshow</span>
                            </a>
                            <a href="/admin/about" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('admin/about') ? 'bg-white/10 shadow-inner' : '' }}">
                                <i class="fas fa-info-circle w-5 h-5"></i>
                                <span class="text-sm font-semibold">Tentang Kami</span>
                            </a>
                            <a href="/admin/stats" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('admin/stats') ? 'bg-white/10 shadow-inner' : '' }}">
                                <i class="fas fa-chart-bar w-5 h-5"></i>
                                <span class="text-sm font-semibold">Statistik</span>
                            </a>
                            <a href="/admin/contact" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('admin/contact') ? 'bg-white/10 shadow-inner' : '' }}">
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

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Manage</p>
                        <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Kelola User</h2>
                        <p class="mt-2 text-sm text-gray-600">Kelola akun pemilik usaha</p>
                    </div>
                    <a href="{{ route('admin.users.create') }}" class="w-full sm:w-auto text-center bg-gradient-to-r from-[#4a1e2b] to-[#7A384D] rounded-full px-6 py-3 text-white font-bold hover:opacity-90 transition">
                        <i class="fas fa-user-plus mr-2"></i> Tambah User
                    </a>
                </div>

                <x-flash-message />

                <x-flash-message />

                {{-- Tabel Desktop --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm text-left mt-6">
                        <thead>
                            <tr>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">User</th>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">Email</th>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">Role</th>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">Status</th>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">Usaha</th>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full {{ $user->isAdmin() ? 'bg-gradient-to-br from-yellow-500 to-yellow-600' : 'bg-gradient-to-br from-blue-500 to-blue-600' }} flex items-center justify-center text-white font-bold text-sm">
                                            {{ strtoupper(substr($user->display_name ?? $user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $user->display_name ?? $user->name }}</p>
                                            <p class="text-xs text-gray-500">@ {{ $user->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">{{ $user->email }}</td>
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $user->role_color }}">
                                        {{ $user->role_label }}
                                    </span>
                                </td>
                                <td class="py-4">
                                    @if ($user->is_active)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        <i class="fas fa-check-circle mr-1"></i> Aktif
                                    </span>
                                    @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        <i class="fas fa-times-circle mr-1"></i> Nonaktif
                                    </span>
                                    @endif
                                </td>
                                <td class="py-4">
                                    @if ($user->businesses->count() > 0)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                        <i class="fas fa-store text-[10px]"></i>
                                        {{ $user->businesses->count() }}
                                    </span>
                                    @else
                                    <span class="text-xs text-gray-400 italic">Belum ada</span>
                                    @endif
                                </td>
                                <td class="py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @if ($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin hapus user ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Card View Mobile --}}
                <div class="md:hidden mt-4 space-y-4">
                    @foreach ($users as $user)
                    <div class="border border-gray-200 rounded-xl p-4 bg-gray-50">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-full {{ $user->isAdmin() ? 'bg-gradient-to-br from-yellow-500 to-yellow-600' : 'bg-gradient-to-br from-blue-500 to-blue-600' }} flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($user->display_name ?? $user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $user->display_name ?? $user->name }}</p>
                                <p class="text-xs text-gray-500">@ {{ $user->name }}</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 mb-2">{{ $user->email }}</p>
                        <div class="flex gap-2 mb-3">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold border {{ $user->role_color }}">
                                {{ $user->role_label }}
                            </span>
                            @if ($user->is_active)
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Aktif</span>
                            @else
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Nonaktif</span>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="flex-1 text-center bg-indigo-500 hover:bg-indigo-600 text-white py-2 rounded-lg text-sm font-semibold transition">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            @if ($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg text-sm font-semibold transition" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
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
    </script>

</body>

</html>