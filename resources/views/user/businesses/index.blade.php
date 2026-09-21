<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usaha Saya - Corner Bisnis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F8F4F0]">

    <div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-gradient-to-r from-[#1a3a2b] to-[#2b5a3f] text-white px-4 py-3 flex items-center justify-between shadow-lg">
        <button class="text-2xl p-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="font-serif text-lg font-bold tracking-wide">RT 04 NGIJO</h1>
        <div class="w-10"></div>
    </div>

    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <div class="min-h-screen flex pt-14 lg:pt-0">

        @include('partials.sidebar-user')

        <div class="flex-1 p-4 lg:p-8 w-full">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-4 lg:p-8 border border-gray-100">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Kelola</p>
                        <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#1a3a2b]">Usaha Saya</h2>
                    </div>
                    <a href="{{ route('user.businesses.create') }}" class="w-full sm:w-auto text-center bg-gradient-to-r from-[#1a3a2b] to-[#2b5a3f] rounded-full px-6 py-3 text-white font-bold hover:opacity-90 transition">
                        <i class="fas fa-plus mr-2"></i> Tambah Usaha
                    </a>
                </div>

                @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                </div>
                @endif

                {{-- Tabel Desktop --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm text-left mt-6">
                        <thead>
                            <tr>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">Kategori</th>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">Nama Usaha</th>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">Jenis / Tipe</th>
                                <th class="pb-4 border-b border-gray-200 text-gray-500 uppercase tracking-wider text-xs">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($businesses as $business)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-[#1a3a2b] text-white">
                                        {{ $business->category->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-4 font-medium">{{ $business->name }}</td>
                                <td class="py-4">{{ $business->type ?? $business->name }}</td>
                                <td class="py-4 whitespace-nowrap">
                                    <a href="{{ route('user.businesses.edit', $business->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('user.businesses.destroy', $business->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin hapus?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-500">
                                    <i class="fas fa-store text-4xl text-gray-300 mb-3 block"></i>
                                    <p>Belum ada usaha</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Card View Mobile --}}
                <div class="md:hidden mt-4 space-y-4">
                    @forelse ($businesses as $business)
                    <div class="border border-gray-200 rounded-xl p-4 bg-gray-50">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-[#1a3a2b] text-white mb-2">
                            {{ $business->category->name ?? '-' }}
                        </span>
                        <h3 class="font-bold text-lg text-gray-900">{{ $business->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $business->type ?? $business->name }}</p>

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
                    @empty
                    <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                        <i class="fas fa-store text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Belum ada usaha</p>
                    </div>
                    @endforelse
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

</html>skrg