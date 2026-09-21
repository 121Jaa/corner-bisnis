<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Admin</title>
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
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                                <i class="fas fa-chart-pie w-5 h-5"></i>
                                <span class="text-sm font-semibold">Dashboard</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Kelola Data</p>
                        <div class="space-y-1">
                            <a href="{{ route('tambahUsaha') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                                <i class="fas fa-plus-circle w-5 h-5"></i>
                                <span class="text-sm font-semibold">Tambah Usaha</span>
                            </a>
                            <a href="{{ route('daftarUsaha') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                                <i class="fas fa-list w-5 h-5"></i>
                                <span class="text-sm font-semibold">Daftar Usaha</span>
                            </a>
                            <a href="{{ route('testimoni') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                                <i class="fas fa-star w-5 h-5"></i>
                                <span class="text-sm font-semibold">Testimoni</span>
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 bg-white/10 shadow-inner">
                                <i class="fas fa-users w-5 h-5"></i>
                                <span class="text-sm font-semibold">Kelola User</span>
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest opacity-40 px-4 mb-2">Konten Web</p>
                        <div class="space-y-1">
                            <a href="/admin/hero" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                                <i class="fas fa-images w-5 h-5"></i>
                                <span class="text-sm font-semibold">Hero Slideshow</span>
                            </a>
                            <a href="/admin/about" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                                <i class="fas fa-info-circle w-5 h-5"></i>
                                <span class="text-sm font-semibold">Tentang Kami</span>
                            </a>
                            <a href="/admin/stats" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                                <i class="fas fa-chart-bar w-5 h-5"></i>
                                <span class="text-sm font-semibold">Statistik</span>
                            </a>
                            <a href="/admin/contact" class="flex items-center gap-3 py-2.5 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
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
            <div class="max-w-3xl mx-auto bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-6 lg:p-8 border border-gray-100">

                <div class="mb-6">
                    <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Create</p>
                    <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Tambah User</h2>
                    <p class="mt-2 text-sm text-gray-600">Bikin akun pemilik usaha baru</p>
                </div>

                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <p class="font-bold mb-1"><i class="fas fa-exclamation-triangle mr-1"></i> Ada error:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Nama (username login) --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            placeholder="contoh: budi_ngijo"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Dipakai buat login. Tanpa spasi.</p>
                    </div>

                    {{-- Display Name --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Tampilan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="display_name" value="{{ old('display_name') }}" required
                            placeholder="contoh: Budi Santoso"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="contoh: budi@email.com"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                    </div>

                    {{-- Password + Generate --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2">
                            <input type="text" name="password" id="passwordInput" value="{{ old('password') }}" required
                                placeholder="min. 6 karakter"
                                class="flex-1 px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                            <button type="button" onclick="generatePassword()"
                                class="px-4 py-3 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-semibold text-gray-700 transition whitespace-nowrap">
                                <i class="fas fa-dice mr-1"></i> Generate
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Catat & kasih ke user. Password bisa diganti nanti.</p>
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select name="role" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Pemilik Usaha)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    {{-- Status Aktif --}}
                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" id="is_active"
                            {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 text-[#7A384D] focus:ring-[#7A384D]">
                        <label for="is_active" class="text-sm font-semibold text-gray-700 cursor-pointer">
                            Aktifkan akun ini
                        </label>
                    </div>

                    {{-- Info: assign usaha setelah user dibuat --}}
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-semibold text-blue-800">Info</p>
                                <p class="text-xs text-blue-700 mt-1">
                                    Setelah user dibuat, kamu bisa <strong>assign usaha</strong> ke user ini di halaman <strong>Edit User</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-[#4a1e2b] to-[#7A384D] rounded-full px-6 py-3 text-white font-bold hover:opacity-90 transition">
                            <i class="fas fa-save mr-2"></i> Simpan User
                        </button>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex-1 text-center bg-gray-100 hover:bg-gray-200 rounded-full px-6 py-3 text-gray-700 font-bold transition">
                            <i class="fas fa-arrow-left mr-2"></i> Batal
                        </a>
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

        function generatePassword() {
            fetch('{{ route('admin.users.generatePassword') }}')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('passwordInput').value = data.password;
                })
                .catch(() => {
                    const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    let pass = '';
                    for (let i = 0; i < 10; i++) {
                        pass += chars.charAt(Math.floor(Math.random() * chars.length));
                    }
                    document.getElementById('passwordInput').value = pass;
                });
        }
    </script>

</body>

</html>