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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F8F4F0]">

    <!-- Sidebar Premium -->
    <div class="min-h-screen flex">
        <div class="w-72 bg-gradient-to-b from-[#2B0F1A] to-[#4A1E2B] text-white flex flex-col shadow-2xl relative">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
            <div class="relative z-10 p-6">
                <div class="flex items-center justify-center gap-3 pb-8">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M3 10v11m18-11v11M9 10V7m3 3V7m3 3V7" />
                    </svg>
                    <div>
                        <h1 class="font-serif text-2xl font-bold tracking-wide">RT 04 NGIJO</h1>
                        <p class="text-xs uppercase tracking-[0.3em] opacity-60">Admin Panel</p>
                    </div>
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
        <div class="flex-1 p-8">
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
                <div class="mb-6">
                    <p class="text-sm uppercase tracking-[0.3em] text-gray-400">Manage</p>
                    <h2 class="font-serif text-4xl font-bold text-[#4a1e2b]">Tambah Usaha</h2>
                </div>

                <form action="{{ route('admin.businesses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Kolom Kiri -->
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
                                <select name="name" id="businessSelect" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]" required>
                                    <!-- Opsi akan diisi otomatis oleh JavaScript -->
                                </select>
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

                            <!-- LINK GOOGLE MAPS -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Link Google Maps</label>
                                <input type="url" name="google_maps_link" id="mapsLinkInput" placeholder="https://maps.app.goo.gl/xxxxx" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Buka Google Maps → cari lokasi → klik <strong>Bagikan</strong> → <strong>Salin link</strong> → paste di sini
                                </p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Nomor HP</label>
                                <input type="text" name="phone" placeholder="6281234567890" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Fasilitas / Menu (pisahkan dengan koma)</label>
                                <input type="text" name="facilities" placeholder="Fasilitas 1, Fasilitas 2, Fasilitas 3" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                            </div>
                        </div>

                        <!-- Kolom Kanan: Gambar & Maps -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2">Gambar</label>
                                <input type="file" name="image" class="w-full border-2 border-gray-300 rounded-lg p-2 focus:outline-none focus:border-[#4a1e2b]">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG, AVIF. Maks 2MB</p>
                            </div>

                            <!-- Google Maps Preview -->
                            <div class="mt-4 rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                <div class="bg-gray-900 px-4 py-3 flex justify-between items-center">
                                    <h3 class="text-sm font-semibold text-white">
                                        <i class="fas fa-map-marked-alt mr-2"></i> Preview Lokasi
                                    </h3>
                                    <button type="button" onclick="updateMap()" class="text-xs text-yellow-400 hover:text-yellow-300 transition">
                                        <i class="fas fa-sync-alt mr-1"></i> Refresh
                                    </button>
                                </div>
                                <div id="mapContainer" class="relative" style="height: 350px;">
                                    <iframe 
                                        id="mapIframe"
                                        src="https://www.google.com/maps?q=RT+04+Ngijo,+Karangploso,+Malang&output=embed"
                                        width="100%" 
                                        height="350" 
                                        style="border:0;" 
                                        allowfullscreen="" 
                                        loading="lazy"
                                        class="w-full">
                                    </iframe>
                                </div>
                                <div class="bg-gray-100 px-4 py-3 text-center flex flex-wrap items-center justify-center gap-3">
                                    <a id="openMapsLink" href="#"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 text-sm font-semibold text-red-500 hover:underline transition">
                                        <i class="fas fa-external-link-alt"></i>
                                        Buka di Google Maps
                                    </a>
                                </div>
                            </div>

                            <!-- Preview WhatsApp -->
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

                    <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                        <a href="{{ route('daftarUsaha') }}" class="mr-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition">Batal</a>
                        <button type="submit" class="bg-[#4a1e2b] hover:bg-[#6b2d3f] text-white font-bold py-2 px-6 rounded-lg transition">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<script>
    const categoriesData = @json($businesses->groupBy('category_id')->map(function($items) {
        return $items->pluck('name')->unique()->values();
    }));

    const categorySelect = document.getElementById('categorySelect');
    const businessSelect = document.getElementById('businessSelect');
    const mapsLinkInput = document.getElementById('mapsLinkInput');
    const mapIframe = document.getElementById('mapIframe');
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

    // Ekstrak koordinat dari link Google Maps
    function extractCoordsFromLink(url) {
        if (!url) return null;
        
        let match = url.match(/@(-?\d+\.\d+),(-?\d+\.\d+)/);
        if (match) return { lat: match[1], lng: match[2] };
        
        match = url.match(/[?&]q=(-?\d+\.\d+),(-?\d+\.\d+)/);
        if (match) return { lat: match[1], lng: match[2] };
        
        match = url.match(/place\/(-?\d+\.\d+),(-?\d+\.\d+)/);
        if (match) return { lat: match[1], lng: match[2] };
        
        match = url.match(/!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/);
        if (match) return { lat: match[1], lng: match[2] };
        
        match = url.match(/[?&]ll=(-?\d+\.\d+),(-?\d+\.\d+)/);
        if (match) return { lat: match[1], lng: match[2] };
        
        return null;
    }

    // Ekstrak nama tempat dari link Google Maps
    function extractPlaceName(url) {
        if (!url) return null;
        
        let match = url.match(/place\/([^\/@]+)/);
        if (match) {
            return decodeURIComponent(match[1].replace(/\+/g, ' '));
        }
        
        match = url.match(/[?&]q=([^&]+)/);
        if (match && !match[1].match(/^-?\d+\.\d+,-?\d+\.\d+$/)) {
            return decodeURIComponent(match[1].replace(/\+/g, ' '));
        }
        
        return null;
    }

    function updateMap() {
        const link = mapsLinkInput.value.trim();
        
        if (!link) {
            mapIframe.src = 'https://www.google.com/maps?q=RT+04+Ngijo,+Karangploso,+Malang&output=embed';
            openMapsLink.href = '#';
            return;
        }
        
        const coords = extractCoordsFromLink(link);
        const placeName = extractPlaceName(link);
        
        if (coords) {
            mapIframe.src = `https://www.google.com/maps?q=${coords.lat},${coords.lng}&output=embed&z=17`;
        } else if (placeName) {
            mapIframe.src = `https://www.google.com/maps?q=${encodeURIComponent(placeName)}&output=embed`;
        } else {
            mapIframe.src = link.replace('/maps/', '/maps/embed/') + (link.includes('?') ? '&' : '?') + 'output=embed';
        }
        
        openMapsLink.href = link;
    }

    mapsLinkInput.addEventListener('change', updateMap);
    mapsLinkInput.addEventListener('paste', function() {
        setTimeout(updateMap, 100);
    });
    mapsLinkInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') updateMap();
    });

    categorySelect.addEventListener('change', updateBusinesses);
    updateBusinesses();
</script>

</html>