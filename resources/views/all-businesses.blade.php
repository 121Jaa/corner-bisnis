<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Usaha - Corner Bisnis RT 04</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

    @include('partials.navbar')

    <!-- Hero Kecil -->
    <section class="relative flex h-[50vh] w-full items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('{{ asset('images/1.avif') }}');">
            <div class="absolute inset-0 bg-black/70"></div>
        </div>

        <!-- Konten di atas gambar -->
        <div class="relative z-10 mx-auto max-w-4xl px-6 pt-24 pb-10 text-center text-white">
            <p class="text-sm font-semibold uppercase tracking-wider text-gray-300">
                Explore
            </p>
            <h1 class="font-serif-display mt-3 text-5xl font-bold">
                Semua Usaha Warga
            </h1>
        </div>
    </section>

    <!-- Grid Semua Usaha -->
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @php
                    $badgeColors = [
                        1 => '#E91E63', // Kos: Pink
                        2 => '#2196F3', // Kuliner: Biru
                        3 => '#4CAF50', // Laundry: Hijau
                        4 => '#FF9800', // Jasa: Orange
                        5 => '#9C27B0', // Toko: Ungu
                    ];
                @endphp

                @forelse ($businesses as $business)
                    @php
                        $badgeColor = $badgeColors[$business->category_id] ?? '#795548';
                    @endphp

                    <a href="{{ route('kos.show', $business->id) }}"
                        class="group block overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('images/' . $business->image) }}" alt="{{ $business->name }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute top-4 right-4 rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white shadow-md"
                                style="background-color: {{ $badgeColor }};">
                                {{ $business->category->name ?? 'Umum' }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900">{{ $business->type ?? $business->name }}</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-600">
                                {{ $business->description ?? 'Deskripsi singkat usaha ini akan segera ditambahkan.' }}
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-900 hover:text-gray-600">Lihat Detail →</span>
                                <span class="text-xs text-gray-400">{{ $business->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <p class="text-4xl">🏪</p>
                        <p class="mt-4 text-lg text-gray-500">Belum ada usaha yang terdaftar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Tombol Kembali -->
    <section class="bg-white pb-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="text-center">
                <a href="{{ route('home') }}"
                    class="inline-block rounded-lg bg-gray-900 px-6 py-3 font-medium text-white transition hover:bg-yellow-500">
                    &larr; Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </section>

</body>

</html>