<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Usaha - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #mapPreview { height: 350px; width: 100%; z-index: 1; }
        @media (max-width: 768px) {
            #mapPreview { height: 280px; }
        }
    </style>
</head>

<body class="bg-[#F8F4F0]">

    <!-- Mobile Top Bar -->
    <div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-gradient-to-r from-[#2B0F1A] to-[#4A1E2B] text-white px-4 py-3 flex items-center justify-between shadow-lg">
        <button class="text-2xl p-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="font-serif text-lg font-bold tracking-wide">RT 04 NGIJO</h1>
        <div class="w-10"></div>
    </div>

    <!-- Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <div class="min-h-screen flex pt-14 lg:pt-0">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed lg:static inset-y-0 left-0 w-72 bg-gradient-to-b from-[#2B0F1A] to-[#4A1E2B] text-white flex flex-col shadow-2xl z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
            <div class="relative z-10 p-6 overflow-y-auto h-full">
                <div class="flex items-center justify-between gap-3 pb-8">
                    <div class="flex items-center justify-center gap-3">
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
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                        <i class="fas fa-chart-pie w-5 h-5"></i>
                        <span class="text-sm font-semibold">Dashboard</span>
                    </a>
                    <a href="{{ route('tambahUsaha') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1 bg-white/10 shadow-inner">
                        <i class="fas fa-plus-circle w-5 h-5"></i>
                        <span class="text-sm font-semibold">Tambah Usaha</span>
                    </a>
                    <a href="{{ route('daftarUsaha') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
                        <i class="fas fa-list w-5 h-5"></i>
                        <span class="text-sm font-semibold">Daftar Usaha</span>
                    </a>
                    <a href="{{ route('testimoni') }}" class="flex items-center gap-3 py-3 px-4 rounded-xl transition-all hover:bg-white/10 hover:translate-x-1">
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

        <!-- Konten Utama -->
        <div class="flex-1 p-4 lg:p-8 w-full">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-4 lg:p-8 border border-gray-100">
                <div class="mb-6">
                    <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Manage</p>
                    <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Tambah Usaha</h2>
                </div>

                <form action="{{ route('admin.businesses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Kategori</label>
                                <select name="category_id" id="categorySelect" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]" required>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Nama Usaha</label>
                                <select name="name" id="businessSelect" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]" required></select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Jenis / Tipe</label>
                                <input type="text" name="type" placeholder="Contoh: Kos Putra A" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Deskripsi</label>
                                <textarea name="description" rows="3" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Alamat</label>
                                <input type="text" name="address" placeholder="RT 04 Ngijo, Karangploso, Malang" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Link Google Maps</label>
                                <input type="text" name="google_maps_link" id="mapsLinkInput" placeholder="https://www.google.com/maps/place/..." class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mt-2">
                                    <p class="text-xs text-yellow-800 font-semibold mb-1">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> CARA DAPET LINK YANG AKURAT:
                                    </p>
                                    <ol class="text-xs text-yellow-700 list-decimal list-inside space-y-1">
                                        <li>Buka <strong>Google Maps</strong> di PC/laptop</li>
                                        <li>Cari lokasi usaha</li>
                                        <li><strong>Copy URL dari address bar</strong> browser</li>
                                        <li>Paste di kolom ini</li>
                                    </ol>
                                    <p class="text-xs text-red-600 mt-2 font-semibold">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        JANGAN pakai link short (maps.app.goo.gl/xxx)!
                                    </p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Nomor HP</label>
                                <input type="text" name="phone" placeholder="6281234567890" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Fasilitas / Menu</label>
                                <input type="text" name="facilities" placeholder="Fasilitas 1, Fasilitas 2" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                            </div>
                        </div>

                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Gambar</label>
                                <input type="file" name="image" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG, AVIF. Maks 2MB</p>
                            </div>

                            <div class="mt-4 rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                <div class="bg-gray-900 px-4 py-3 flex justify-between items-center">
                                    <h3 class="text-sm font-semibold text-white">
                                        <i class="fas fa-map-marked-alt mr-2"></i> Preview Lokasi
                                    </h3>
                                    <button type="button" onclick="updateMap()" class="text-xs text-yellow-400 hover:text-yellow-300 transition">
                                        <i class="fas fa-sync-alt mr-1"></i> Refresh
                                    </button>
                                </div>
                                <div id="mapPreview"></div>
                                <div class="bg-gray-100 px-4 py-3 text-center">
                                    <a id="openMapsLink" href="#"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 text-sm font-semibold text-red-500 hover:underline">
                                        <i class="fas fa-external-link-alt"></i>
                                        Buka di Google Maps
                                    </a>
                                </div>
                            </div>

                            <div class="mt-4 rounded-xl border border-green-200 bg-green-50 p-4">
                                <div class="flex items-center gap-3">
                                    <i class="fab fa-whatsapp text-2xl text-green-500"></i>
                                    <div>
                                        <p class="font-semibold text-gray-700">Kontak WhatsApp</p>
                                        <p class="text-sm text-gray-600">Masukkan nomor HP di atas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 border-t border-gray-200 pt-6">
                        <a href="{{ route('daftarUsaha') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition text-center">Batal</a>
                        <button type="submit" class="bg-[#4a1e2b] hover:bg-[#6b2d3f] text-white font-bold py-2 px-6 rounded-lg transition">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // ============= SIDEBAR TOGGLE =============
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // ============= DROPDOWN KATEGORI =============
        const categoriesData = @json($businesses->groupBy('category_id')->map(function($items) {
            return $items->pluck('name')->unique()->values();
        }));

        const categorySelect = document.getElementById('categorySelect');
        const businessSelect = document.getElementById('businessSelect');
        const mapsLinkInput = document.getElementById('mapsLinkInput');
        const openMapsLink = document.getElementById('openMapsLink');

        function updateBusinesses() {
            const selectedCategoryId = categorySelect.value;
            businessSelect.innerHTML = '';

            if (categoriesData[selectedCategoryId]) {
                categoriesData[selectedCategoryId].forEach(function(name) {
                    const option = document.createElement('option');
                    option.value = name;
                    option.textContent = name;
                    businessSelect.appendChild(option);
                });
            }
        }

        // ============= LEAFLET MAP PREVIEW =============
        const defaultLat = -7.8837997;
        const defaultLng = 112.5743297;

        const mapPreview = L.map('mapPreview').setView([defaultLat, defaultLng], 14);

        const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap',
            maxZoom: 19
        }).addTo(mapPreview);

        const markerPreview = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(mapPreview);

        function extractCoordsFromLink(url) {
            if (!url) return null;

            let match = url.match(/!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/);
            if (match) return { lat: parseFloat(match[1]), lng: parseFloat(match[2]) };

            match = url.match(/[?&]q=(-?\d+\.\d+),(-?\d+\.\d+)/);
            if (match) return { lat: parseFloat(match[1]), lng: parseFloat(match[2]) };

            match = url.match(/place\/(-?\d+\.\d+),(-?\d+\.\d+)/);
            if (match) return { lat: parseFloat(match[1]), lng: parseFloat(match[2]) };

            match = url.match(/[?&]ll=(-?\d+\.\d+),(-?\d+\.\d+)/);
            if (match) return { lat: parseFloat(match[1]), lng: parseFloat(match[2]) };

            match = url.match(/@(-?\d+\.\d+),(-?\d+\.\d+)/);
            if (match) return { lat: parseFloat(match[1]), lng: parseFloat(match[2]) };

            return null;
        }

        function updateMap() {
            const link = mapsLinkInput.value.trim();
            openMapsLink.href = link || '#';

            if (!link) {
                mapPreview.setView([defaultLat, defaultLng], 14);
                markerPreview.setLatLng([defaultLat, defaultLng]);
                return;
            }

            const coords = extractCoordsFromLink(link);

            if (coords) {
                console.log('✅ Coords extracted:', coords);
                mapPreview.invalidateSize();
                mapPreview.setView([coords.lat, coords.lng], 17);
                markerPreview.setLatLng([coords.lat, coords.lng]);
                markerPreview.bindPopup(`📍 ${coords.lat}, ${coords.lng}`).openPopup();
                tileLayer.redraw();
            } else {
                console.warn('⚠️ No coords found');
            }
        }

        mapsLinkInput.addEventListener('input', updateMap);
        mapsLinkInput.addEventListener('change', updateMap);
        mapsLinkInput.addEventListener('paste', function() {
            setTimeout(updateMap, 50);
        });
        mapsLinkInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') updateMap();
        });

        markerPreview.on('dragend', function() {
            const pos = markerPreview.getLatLng();
            const newLink = `https://www.google.com/maps?q=${pos.lat.toFixed(7)},${pos.lng.toFixed(7)}`;
            mapsLinkInput.value = newLink;
            openMapsLink.href = newLink;
        });

        categorySelect.addEventListener('change', updateBusinesses);
        updateBusinesses();
    </script>

</body>

</html>