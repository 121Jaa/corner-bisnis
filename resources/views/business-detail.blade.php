<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Usaha - Corner Bisnis RT 04</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

    @include('partials.navbar')

    <!-- Hero Detail Usaha -->
    <section class="relative flex h-[50vh] w-full items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-cover bg-center"
            style="background-image: url('{{ $business->image ? asset('images/' . $business->image) : asset('images/1.avif') }}');">
            <div class="absolute inset-0 bg-black/70"></div>
        </div>
        <div class="relative z-10 mx-auto max-w-4xl px-6 pt-24 pb-10 text-center text-white">
            <p class="text-sm font-semibold uppercase tracking-wider text-gray-300">
                {{ $business->category->name ?? 'Umum' }}
            </p>
            <h1 class="font-serif-display mt-3 text-5xl font-bold">
                {{ $business->type ?? $business->name }}
            </h1>
        </div>
    </section>

    <!-- Detail Usaha + Google Maps -->
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                <!-- Kolom Kiri: Info Usaha -->
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-gray-500">
                        Detail Usaha
                    </p>
                    <h2 class="font-serif-display mt-4 text-4xl font-bold">
                        {{ $business->type ?? $business->name }}
                    </h2>

                    <!-- Gambar Cover -->
                    <div class="mt-6 overflow-hidden rounded-xl shadow-lg">
                        <img src="{{ asset('images/' . ($business->image ?? '1.avif')) }}" alt="{{ $business->name }}"
                            class="h-80 w-full object-cover">
                    </div>

                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        {{ $business->description ?? 'Deskripsi singkat usaha ini akan segera ditambahkan.' }}
                    </p>

                    <!-- LOKASI -->
                    <div class="mt-6 rounded-xl border border-gray-200 bg-gray-50 p-4">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-map-pin text-xl text-red-500 mt-1"></i>
                            <div>
                                <p class="font-semibold text-gray-700">Lokasi</p>
                                <p class="text-gray-600">{{ $business->address ?? 'RT 04 Ngijo, Karangploso, Malang' }}</p>
                                @if ($business->google_maps_link)
                                <a href="{{ $business->google_maps_link }}" target="_blank"
                                    class="mt-1 inline-flex items-center gap-1 text-sm text-red-500 hover:underline">
                                    <i class="fas fa-external-link-alt text-xs"></i>
                                    Lihat di Google Maps
                                </a>
                                @else
                                <a href="https://www.google.com/maps/search/{{ urlencode($business->address ?? 'RT 04 Ngijo, Karangploso, Malang') }}"
                                    target="_blank"
                                    class="mt-1 inline-flex items-center gap-1 text-sm text-red-500 hover:underline">
                                    <i class="fas fa-external-link-alt text-xs"></i>
                                    Lihat di Google Maps
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- KONTAK -->
                    <div class="mt-4 rounded-xl border border-gray-200 bg-gray-50 p-4">
                        <div class="flex items-start gap-3">
                            <i class="fab fa-whatsapp text-xl text-green-500 mt-1"></i>
                            <div>
                                <p class="font-semibold text-gray-700">Kontak</p>
                                <p class="text-gray-600">{{ $business->phone ?? '6281234567890' }}</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $business->phone ?? '6281234567890') }}?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($business->name ?? 'usaha') }}"
                                    target="_blank"
                                    class="mt-2 inline-flex items-center gap-2 rounded-lg bg-green-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-600">
                                    <i class="fab fa-whatsapp"></i>
                                    Hubungi via WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Fasilitas / Menu -->
                    @if ($business->facilities)
                    <div class="mt-6 rounded-xl border border-gray-200 p-4">
                        <p class="font-semibold text-gray-700">Fasilitas / Menu:</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach (explode(',', $business->facilities) as $facility)
                            <span class="rounded-full bg-yellow-100 px-4 py-2 text-sm text-yellow-800">
                                <i class="fas fa-check-circle text-yellow-600 mr-1"></i>
                                {{ trim($facility) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- ⭐ GALERI — ANTI ERROR --}}
                    @php
                        // Ambil data mentah
                        $rawImages = $business->images;

                        // Kalau string, decode
                        if (is_string($rawImages)) {
                            $decoded = json_decode($rawImages, true);
                            $rawImages = is_array($decoded) ? $decoded : [];
                        }

                        // Kalau bukan array, jadi []
                        if (!is_array($rawImages)) {
                            $rawImages = [];
                        }

                        // Flatten + filter cuma string
                        $galeriImages = [];
                        $queue = $rawImages;
                        while (!empty($queue)) {
                            $item = array_shift($queue);
                            if (is_array($item)) {
                                $queue = array_merge($queue, $item);
                            } elseif (is_string($item) && trim($item) !== '' && file_exists(public_path($item))) {
                                $galeriImages[] = $item;
                            }
                        }
                    @endphp

                    @if (count($galeriImages) > 0)
                    <div class="mt-6 rounded-xl border border-gray-200 p-4">
                        <p class="font-semibold text-gray-700 mb-3">
                            <i class="fas fa-images text-[#4a1e2b] mr-2"></i> Galeri Foto
                            <span class="text-xs text-gray-500">({{ count($galeriImages) }} gambar)</span>
                        </p>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ($galeriImages as $index => $img)
                                @if (is_string($img))
                                <div class="relative group cursor-pointer overflow-hidden rounded-lg border border-gray-200"
                                    onclick="openLightbox('{{ asset($img) }}', {{ $index }})">
                                    <img src="{{ asset($img) }}" alt="Foto {{ $index + 1 }}"
                                        class="w-full h-32 md:h-40 object-cover transition-transform duration-300 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition flex items-center justify-center">
                                        <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition"></i>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Kolom Kanan: Google Maps -->
                <div class="lg:mt-0">
                    <div class="sticky top-24 overflow-hidden rounded-2xl shadow-lg">
                        <div class="bg-gray-900 px-4 py-3">
                            <h3 class="text-sm font-semibold text-white">
                                <i class="fas fa-map-marked-alt mr-2"></i> Lokasi Kami
                            </h3>
                        </div>

                        @if ($business->google_maps_link)
                        <iframe id="detailMapIframe" src="" width="100%" height="550" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            class="h-full min-h-[500px] w-full"></iframe>

                        <div class="bg-gray-100 px-4 py-3 text-center flex flex-wrap items-center justify-center gap-3">
                            <a href="{{ $business->google_maps_link }}" target="_blank"
                                class="inline-flex items-center gap-2 text-sm font-semibold text-red-500 hover:underline">
                                <i class="fas fa-external-link-alt"></i>
                                Buka di Google Maps
                            </a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ $business->google_maps_link }}&destination_place_id=" target="_blank"
                                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-500 hover:underline">
                                <i class="fas fa-directions"></i>
                                Petunjuk Arah
                            </a>
                        </div>
                        @else
                        <iframe
                            src="https://www.google.com/maps?q={{ urlencode($business->address ?? 'RT 04 Ngijo, Karangploso, Malang') }}&output=embed&z=15"
                            width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy"
                            class="h-full min-h-[500px] w-full"></iframe>

                        <div class="bg-gray-100 px-4 py-3 text-center">
                            <a href="https://www.google.com/maps/search/{{ urlencode($business->address ?? 'RT 04 Ngijo, Karangploso, Malang') }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 text-sm font-semibold text-red-500 hover:underline">
                                <i class="fas fa-external-link-alt"></i>
                                Buka di Google Maps
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
    $relatedTitle = match ($business->category_id) {
    1 => 'Kos Lainnya',
    2 => 'Kuliner Lainnya',
    3 => 'Laundry Lainnya',
    4 => 'Jasa Lainnya',
    5 => 'Toko Lainnya',
    default => 'Usaha Lainnya',
    };
    @endphp

    <!-- SECTION: USAHA LAINNYA -->
    <section class="bg-gray-50 py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-12 text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-gray-500">
                    Explore
                </p>
                <h2 class="font-serif-display mt-4 text-4xl font-bold">
                    {{ $relatedTitle }}
                </h2>
                <div class="mx-auto mt-6 w-24 border-t-2 border-yellow-500"></div>
                <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-600">
                    Pilih usaha lain yang mungkin cocok untuk kamu.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($relatedBusinesses as $item)
                <a href="{{ route('kos.show', $item->id) }}"
                    class="group block overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/' . ($item->image ?? '1.avif')) }}" alt="{{ $item->name }}"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute top-4 right-4 rounded-full bg-black/70 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white shadow-md">
                            {{ $item->category->name ?? 'Umum' }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900">{{ $item->type ?? $item->name }}</h3>
                        <p class="mt-2 text-sm leading-6 text-gray-600">
                            {{ $item->description ?? 'Deskripsi singkat usaha ini akan segera ditambahkan.' }}
                        </p>

                        <div class="mt-2 flex items-center gap-1 text-sm text-gray-500">
                            <i class="fas fa-map-pin text-red-500"></i>
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
                    <p class="mt-4 text-lg text-gray-500">Belum ada usaha lain yang terdaftar.</p>
                </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if ($relatedBusinesses->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $relatedBusinesses->links() }}
            </div>
            @endif
        </div>
    </section>

    <!-- ⭐ LIGHTBOX MODAL -->
    <div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 z-10">
            <i class="fas fa-times"></i>
        </button>
        <button onclick="event.stopPropagation(); prevImage()" class="absolute left-4 text-white text-4xl hover:text-gray-300 z-10">
            <i class="fas fa-chevron-left"></i>
        </button>
        <img id="lightboxImage" src="" class="max-w-full max-h-full object-contain rounded-lg" onclick="event.stopPropagation()">
        <button onclick="event.stopPropagation(); nextImage()" class="absolute right-4 text-white text-4xl hover:text-gray-300 z-10">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white text-sm">
            <span id="lightboxCounter"></span>
        </div>
    </div>

    <!-- Script Auto-Embed Google Maps + Lightbox -->
    <script>
        (function() {
            const link = @json($business->google_maps_link ?? null);
            const iframe = document.getElementById('detailMapIframe');

            if (!iframe || !link) return;

            let coords = null;

            let match = link.match(/!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/);
            if (match) coords = { lat: match[1], lng: match[2] };

            if (!coords) {
                match = link.match(/[?&]q=(-?\d+\.\d+),(-?\d+\.\d+)/);
                if (match) coords = { lat: match[1], lng: match[2] };
            }

            if (!coords) {
                match = link.match(/place\/(-?\d+\.\d+),(-?\d+\.\d+)/);
                if (match) coords = { lat: match[1], lng: match[2] };
            }

            if (!coords) {
                match = link.match(/[?&]ll=(-?\d+\.\d+),(-?\d+\.\d+)/);
                if (match) coords = { lat: match[1], lng: match[2] };
            }

            if (!coords) {
                match = link.match(/@(-?\d+\.\d+),(-?\d+\.\d+)/);
                if (match) coords = { lat: match[1], lng: match[2] };
            }

            if (coords) {
                iframe.src = 'https://www.google.com/maps?q=' + coords.lat + ',' + coords.lng + '&output=embed&z=18';
            } else {
                let placeMatch = link.match(/place\/([^\/@]+)/);
                if (placeMatch) {
                    const placeName = decodeURIComponent(placeMatch[1].replace(/\+/g, ' '));
                    iframe.src = 'https://www.google.com/maps?q=' + encodeURIComponent(placeName) + '&output=embed';
                } else {
                    iframe.src = 'https://www.google.com/maps?q={{ urlencode($business->address ?? 'RT 04 Ngijo, Karangploso, Malang') }}&output=embed';
                }
            }
        })();

        // ⭐ GALERI LIGHTBOX — HANDLE SEMUA TIPE
        @php
            $rawForJs = $business->images;
            if (is_string($rawForJs)) {
                $decoded = json_decode($rawForJs, true);
                $rawForJs = is_array($decoded) ? $decoded : [];
            }
            if (!is_array($rawForJs)) $rawForJs = [];

            $flatForJs = [];
            $queue = $rawForJs;
            while (!empty($queue)) {
                $item = array_shift($queue);
                if (is_array($item)) {
                    $queue = array_merge($queue, $item);
                } elseif (is_string($item) && trim($item) !== '' && file_exists(public_path($item))) {
                    $flatForJs[] = $item;
                }
            }

            $jsImages = array_map(function($i) {
                return asset($i);
            }, $flatForJs);
        @endphp
        const galleryImages = @json($jsImages);
        let currentIndex = 0;

        function openLightbox(imgSrc, index) {
            const lb = document.getElementById('lightbox');
            const img = document.getElementById('lightboxImage');
            img.src = imgSrc;
            currentIndex = index;
            lb.classList.remove('hidden');
            lb.classList.add('flex');
            document.body.style.overflow = 'hidden';
            updateCounter();
        }

        function closeLightbox() {
            const lb = document.getElementById('lightbox');
            lb.classList.add('hidden');
            lb.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function nextImage() {
            if (galleryImages.length === 0) return;
            currentIndex = (currentIndex + 1) % galleryImages.length;
            document.getElementById('lightboxImage').src = galleryImages[currentIndex];
            updateCounter();
        }

        function prevImage() {
            if (galleryImages.length === 0) return;
            currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
            document.getElementById('lightboxImage').src = galleryImages[currentIndex];
            updateCounter();
        }

        function updateCounter() {
            const counter = document.getElementById('lightboxCounter');
            if (counter) {
                counter.textContent = (currentIndex + 1) + ' / ' + galleryImages.length;
            }
        }

        document.addEventListener('keydown', function(e) {
            const lb = document.getElementById('lightbox');
            if (!lb || lb.classList.contains('hidden')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
        });
    </script>

</body>

</html>