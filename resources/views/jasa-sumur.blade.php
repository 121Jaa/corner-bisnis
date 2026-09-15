<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasa Sumur - Corner Bisnis RT 04</title>

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
        <div class="relative z-10 mx-auto max-w-4xl px-6 pt-24 pb-10 text-center text-white">
            <p class="text-sm font-semibold uppercase tracking-wider text-gray-300">
                Explore
            </p>
            <h1 class="font-serif-display mt-3 text-5xl font-bold">
                Jasa Sumur
            </h1>
        </div>
    </section>

    <!-- Grid Jasa Travel -->
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($jasaSumur as $item)
                    <a href="{{ route('jasa.show', $item->id) }}"
                        class="group block overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div
                                class="absolute top-4 right-4 rounded-full bg-black/70 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white shadow-md">
                                {{ $item->category->name ?? 'Jasa' }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900">{{ $item->type ?? $item->name }}</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-600">
                                {{ $item->description ?? 'Deskripsi singkat usaha ini akan segera ditambahkan.' }}
                            </p>

                            <!-- Lokasi -->
                            <div class="mt-2 flex items-center gap-1 text-sm text-gray-500">
                                <span class="text-red-500">📍</span>
                                <span>{{ $item->address ?? 'RT 04 Ngijo, Karangploso, Malang' }}</span>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-900 hover:text-gray-600">Lihat Detail →</span>
                                <span class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <p class="text-4xl">🏪</p>
                        <p class="mt-4 text-lg text-gray-500">Belum ada jasa sumur yang terdaftar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Tombol Kembali -->
    <section class="bg-white pb-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="text-center">
                <a href="{{ route('jasa') }}" class="inline-block rounded-lg bg-gray-900 px-6 py-3 font-medium text-white transition hover:bg-yellow-500">
                    &larr; Kembali ke Jasa
                </a>
            </div>
        </div>
    </section>

    <!-- Script Navbar -->
    <script>
        const navbar = document.getElementById('main-navbar');
        const navbarContainer = navbar ? navbar.querySelector('div') : null;

        const handleScroll = () => {
            if (navbar && navbarContainer) {
                if (window.scrollY > 50) {
                    navbarContainer.classList.remove('py-5');
                    navbarContainer.classList.add('py-3');
                    navbar.classList.remove('bg-transparent');
                    navbar.classList.add('bg-white', 'shadow-md');
                    navbar.querySelectorAll('a, button').forEach(el => {
                        if (!el.closest('.group') || el.classList.contains('text-white')) {
                            el.classList.remove('text-white', 'hover:text-gray-300');
                            el.classList.add('text-gray-900', 'hover:text-gray-600');
                        }
                    });
                } else {
                    navbarContainer.classList.remove('py-3');
                    navbarContainer.classList.add('py-5');
                    navbar.classList.remove('bg-white', 'shadow-md');
                    navbar.classList.add('bg-transparent');
                    navbar.querySelectorAll('a, button').forEach(el => {
                        if (!el.closest('.group') || el.classList.contains('text-gray-900')) {
                            el.classList.remove('text-gray-900', 'hover:text-gray-600');
                            el.classList.add('text-white', 'hover:text-gray-300');
                        }
                    });
                }
            }
        };

        window.addEventListener('scroll', handleScroll);
        window.addEventListener('load', handleScroll);
    </script>

</body>
</html>