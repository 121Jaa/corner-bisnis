<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Usaha - Pemilik Usaha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #mapPreview {
            height: 350px;
            width: 100%;
            z-index: 1;
        }

        @media (max-width: 768px) {
            #mapPreview {
                height: 280px;
            }
        }
    </style>
</head>

<body class="bg-[#F8F4F0]">

    <!-- Mobile Top Bar -->
    <div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-gradient-to-r from-[#1a3a2b] to-[#2b5a3f] text-white px-4 py-3 flex items-center justify-between shadow-lg">
        <button class="text-2xl p-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="font-serif text-lg font-bold tracking-wide">RT 04 NGIJO</h1>
        <div class="w-10"></div>
    </div>

    <!-- Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <div class="min-h-screen flex pt-14 lg:pt-0">

        @include('partials.sidebar-user')

        <!-- Konten Utama -->
        <div class="flex-1 p-4 lg:p-8 w-full">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-4 lg:p-8 border border-gray-100">
                <div class="mb-6">
                    <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Kelola</p>
                    <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#1a3a2b]">Tambah Usaha</h2>
                    <p class="mt-2 text-sm text-gray-600">Pilih usaha dari daftar yang tersedia</p>
                </div>

                {{-- ⭐ INFO: Hubungi admin kalau usaha gak ada --}}
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5 text-lg"></i>
                        <div>
                            <p class="text-sm font-semibold text-blue-800">Info Penting</p>
                            <p class="text-xs text-blue-700 mt-1">
                                Jika ingin menambahkan usaha lain yang belum tersedia di daftar,
                                silakan <strong>diskusi dengan admin RT</strong> terlebih dahulu.
                            </p>
                        </div>
                    </div>
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

                <form action="{{ route('user.businesses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Kategori</label>
                                <select name="category_id" id="categorySelect" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#1a3a2b]" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Nama Usaha</label>
                                <select name="name" id="businessSelect" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#1a3a2b]" required disabled>
                                    <option value="">-- Pilih Kategori Dulu --</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Jenis / Tipe</label>
                                <input type="text" name="type" placeholder="Contoh: Kos Putra A" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#1a3a2b]">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Deskripsi</label>
                                <textarea name="description" rows="3" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#1a3a2b]"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Alamat</label>
                                <input type="text" name="address" placeholder="RT 04 Ngijo, Karangploso, Malang" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#1a3a2b]">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Link Google Maps</label>
                                <input type="text" name="google_maps_link" id="mapsLinkInput" placeholder="https://www.google.com/maps/place/..." class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#1a3a2b]">
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
                                <input type="text" name="phone" placeholder="6281234567890" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#1a3a2b]">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Fasilitas / Menu</label>
                                <input type="text" name="facilities" placeholder="Fasilitas 1, Fasilitas 2" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#1a3a2b]">
                            </div>
                        </div>

                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Gambar Cover (Utama)</label>
                                <input type="file" name="image" accept="image/*" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                                <p class="text-xs text-gray-500 mt-1">1 gambar utama. Format: JPG, PNG. Maks 2MB</p>
                            </div>

                            {{-- ⭐ GALERI DETAIL --}}
                            <div class="mb-4 p-3 border-2 border-blue-200 bg-blue-50 rounded-lg">
                                <label class="block text-sm font-medium mb-2">
                                    <i class="fas fa-images text-blue-500 mr-1"></i>
                                    Galeri Foto Detail <span class="text-xs text-gray-500">(Max 10 gambar)</span>
                                </label>
                                <input type="file" name="images[]" multiple accept="image/*"
                                    class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                                <p class="text-xs text-gray-500 mt-1">
                                    Bisa pilih banyak sekaligus (tahan <kbd class="bg-gray-200 px-1 rounded">Ctrl</kbd>). Maks 10 gambar.
                                </p>
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
                        <a href="{{ route('user.businesses.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition text-center">Batal</a>
                        <button type="submit" class="bg-[#1a3a2b] hover:bg-[#2b5a3f] text-white font-bold py-2 px-6 rounded-lg transition">
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
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // ============= DATA DROPDOWN =============
        const businessesData = @json($businesses);

        const categoriesData = {};
        businessesData.forEach(function(biz) {
            if (!categoriesData[biz.category_id]) {
                categoriesData[biz.category_id] = [];
            }

            const isDuplicate = categoriesData[biz.category_id].some(function(item) {
                return item.name === biz.name;
            });

            if (!isDuplicate) {
                categoriesData[biz.category_id].push({
                    id: biz.id,
                    name: biz.name,
                    type: biz.type,
                    category_id: biz.category_id,
                });
            }
        });

        const categorySelect = document.getElementById('categorySelect');
        const businessSelect = document.getElementById('businessSelect');
        const mapsLinkInput = document.getElementById('mapsLinkInput');
        const openMapsLink = document.getElementById('openMapsLink');

        function updateBusinesses() {
            const selectedCategoryId = categorySelect.value;
            businessSelect.innerHTML = '';

            if (!selectedCategoryId) {
                businessSelect.innerHTML = '<option value="">-- Pilih Kategori Dulu --</option>';
                businessSelect.disabled = true;
                return;
            }

            if (!categoriesData[selectedCategoryId] || categoriesData[selectedCategoryId].length === 0) {
                businessSelect.innerHTML = '<option value="">-- Belum ada usaha di kategori ini --</option>';
                businessSelect.disabled = true;
                return;
            }

            businessSelect.innerHTML = '<option value="">-- Pilih Nama Usaha --</option>';

            categoriesData[selectedCategoryId].forEach(function(biz) {
                const option = document.createElement('option');
                option.value = biz.name;
                option.textContent = biz.name;
                businessSelect.appendChild(option);
            });

            businessSelect.disabled = false;
        }

        // ============= LEAFLET MAP =============
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
                mapPreview.invalidateSize();
                mapPreview.setView([coords.lat, coords.lng], 17);
                markerPreview.setLatLng([coords.lat, coords.lng]);
                markerPreview.bindPopup('📍 ' + coords.lat + ', ' + coords.lng).openPopup();
                tileLayer.redraw();
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
            const newLink = 'https://www.google.com/maps?q=' + pos.lat.toFixed(7) + ',' + pos.lng.toFixed(7);
            mapsLinkInput.value = newLink;
            openMapsLink.href = newLink;
        });

        categorySelect.addEventListener('change', updateBusinesses);
    </script>

</body>

</html>