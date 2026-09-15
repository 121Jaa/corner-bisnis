<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Testimoni - Corner Bisnis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F8F4F0]">

    <!-- Sidebar Premium -->
    <div class="min-h-screen flex">
        <div class="w-72 bg-gradient-to-b from-[#2B0F1A] to-[#4A1E2B] text-white flex flex-col shadow-2xl relative">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
            <div class="relative z-10 p-6">
                <div class="flex items-center justify-center gap-3 pb-8">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M3 10v11m18-11v11M9 10V7m3 3V7m3 3V7" /></svg>
                    <div>
                        <h1 class="font-serif text-2xl font-bold tracking-wide">RT 04 NGIJO</h1>
                        <p class="text-xs uppercase tracking-[0.3em] opacity-60">Admin Panel</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <a href="/" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        <span class="text-sm font-semibold">Home</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('dashboard') ? 'bg-white/10 shadow-inner' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" /></svg>
                        <span class="text-sm font-semibold">Dashboard</span>
                    </a>
                    <a href="{{ route('tambahUsaha') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('tambahUsaha') ? 'bg-white/10 shadow-inner' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        <span class="text-sm font-semibold">Tambah Usaha</span>
                    </a>
                    <a href="{{ route('daftarUsaha') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 {{ request()->is('daftarUsaha') ? 'bg-white/10 shadow-inner' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                        <span class="text-sm font-semibold">Daftar Usaha</span>
                    </a>
                    <a href="{{ route('testimoni') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl bg-white/10 shadow-inner transition-all hover:translate-x-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" /></svg>
                        <span class="text-sm font-semibold">Testimoni</span>
                    </a>
                    <a href="/logout" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        <span class="text-sm font-semibold">Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="flex-1 p-8">
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
                <h2 class="font-serif text-4xl font-bold text-[#4a1e2b]">Tambah Testimoni</h2>

                <form action="{{ route('testimoni.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Nama</label>
                        <input type="text" name="name" class="w-full border-2 border-gray-300 rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Konten</label>
                        <textarea name="content" rows="4" class="w-full border-2 border-gray-300 rounded p-2" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Gambar</label>
                        <input type="file" name="image" class="w-full border-2 border-gray-300 rounded p-2">
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('testimoni') }}" class="mr-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Batal</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>