<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin</title>
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
                    <p class="text-xs lg:text-sm uppercase tracking-[0.3em] text-gray-400">Edit</p>
                    <h2 class="font-serif text-2xl lg:text-4xl font-bold text-[#4a1e2b]">Edit User</h2>
                    <p class="mt-2 text-sm text-gray-600">Update data akun {{ $user->display_name ?? $user->name }}</p>
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

                @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                    <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                </div>
                @endif

                {{-- FORM UPDATE USER --}}
                <form id="updateUserForm" action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Tampilan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="display_name" value="{{ old('display_name', $user->display_name) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                    </div>

                    <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-key text-yellow-600 mr-1"></i> Reset Password
                        </label>
                        <div class="flex gap-2">
                            <input type="text" name="password" id="passwordInput"
                                placeholder="Kosongkan kalau gak mau ganti"
                                class="flex-1 px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                            <button type="button" onclick="generatePassword()"
                                class="px-4 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl text-sm font-semibold transition whitespace-nowrap">
                                <i class="fas fa-dice mr-1"></i> Generate
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Cuma diisi kalau mau reset password user ini.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select name="role" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#7A384D] focus:ring-2 focus:ring-[#7A384D]/20 outline-none transition">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User (Pemilik Usaha)</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" id="is_active"
                            {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 text-[#7A384D] focus:ring-[#7A384D]">
                        <label for="is_active" class="text-sm font-semibold text-gray-700 cursor-pointer">
                            Akun aktif (bisa login)
                        </label>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-[#4a1e2b] to-[#7A384D] rounded-full px-6 py-3 text-white font-bold hover:opacity-90 transition">
                            <i class="fas fa-save mr-2"></i> Update User
                        </button>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex-1 text-center bg-gray-100 hover:bg-gray-200 rounded-full px-6 py-3 text-gray-700 font-bold transition">
                            <i class="fas fa-arrow-left mr-2"></i> Batal
                        </a>
                    </div>
                </form>

                {{-- ===== ASSIGN USAHA ===== --}}
                <div class="mt-8 p-5 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                            <i class="fas fa-store text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Usaha yang Dimiliki</p>
                            <p class="text-xs text-gray-500">Assign usaha ke user ini</p>
                        </div>
                    </div>

                    @if ($user->businesses && $user->businesses->count() > 0)
                    <div class="space-y-2 mb-4">
                        @foreach ($user->businesses as $biz)
                        <div class="flex items-center justify-between gap-3 p-3 bg-white rounded-xl border border-blue-100 shadow-sm">
                            <div class="flex items-start gap-3 min-w-0 flex-1">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fas fa-store text-blue-600 text-xs"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-bold text-gray-800 leading-tight truncate">
                                        {{ $biz->type ?: $biz->name }}
                                    </p>
                                    <div class="flex flex-wrap items-center gap-1.5 mt-1">
                                        <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded">
                                            <i class="fas fa-tag text-[9px]"></i>
                                            {{ $biz->category_name }}
                                        </span>
                                        @if ($biz->address)
                                        <span class="inline-flex items-center gap-1 text-[11px] text-gray-500">
                                            <i class="fas fa-map-marker-alt text-[9px] text-gray-400"></i>
                                            <span class="truncate max-w-[180px]">{{ $biz->address }}</span>
                                        </span>
                                        @endif
                                        <span class="text-[10px] font-mono text-gray-400 bg-gray-100 px-1.5 py-0.5 rounded">
                                            ID: {{ $biz->id }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('admin.users.unassign-business', [$user->id, $biz->id]) }}" method="POST"
                                onsubmit="return confirm('Lepas usaha ini dari user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition whitespace-nowrap">
                                    <i class="fas fa-unlink mr-1"></i> Lepas
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="p-4 bg-white/60 rounded-xl border border-dashed border-blue-300 text-center mb-4">
                        <i class="fas fa-inbox text-blue-300 text-2xl mb-1"></i>
                        <p class="text-xs text-gray-500">Belum ada usaha yang di-assign</p>
                    </div>
                    @endif

                    @php
                    $availableBusinesses = \App\Models\Business::whereNull('user_id')
                        ->with('category')
                        ->get();
                    $businessesByCategory = $availableBusinesses->groupBy('category_id');
                    $availableCategories = \App\Models\Category::whereIn('id', $businessesByCategory->keys())->orderBy('name')->get();
                    @endphp

                    @if ($availableBusinesses->count() > 0)
                    <details class="group" open>
                        <summary class="cursor-pointer flex items-center justify-between p-3 bg-white rounded-xl border border-blue-200 hover:border-blue-400 transition list-none">
                            <span class="text-sm font-semibold text-blue-700">
                                <i class="fas fa-plus-circle mr-1"></i> Assign Usaha Baru ({{ $availableBusinesses->count() }} tersedia)
                            </span>
                            <i class="fas fa-chevron-down text-blue-500 text-xs group-open:rotate-180 transition-transform"></i>
                        </summary>

                        <form action="{{ route('admin.users.assign-business', $user->id) }}" method="POST" class="mt-3 p-4 bg-white rounded-xl border border-blue-200">
                            @csrf

                            <p class="text-xs text-gray-500 mb-3">Pilih kategori & nama usaha yang mau di-assign:</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                        <i class="fas fa-tags text-blue-500 mr-1"></i> Kategori
                                    </label>
                                    <select id="assignCategorySelect"
                                        class="w-full px-3 py-2.5 text-sm border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($availableCategories as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->name }} ({{ $businessesByCategory[$cat->id]->count() }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                        <i class="fas fa-store text-blue-500 mr-1"></i> Nama Usaha
                                    </label>
                                    <select name="business_ids[]" id="assignBusinessSelect" required disabled
                                        class="w-full px-3 py-2.5 text-sm border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition disabled:bg-gray-100 disabled:cursor-not-allowed">
                                        <option value="">-- Pilih Kategori Dulu --</option>
                                    </select>
                                </div>
                            </div>

                            @error('business_ids')
                            <p class="text-red-500 text-xs mb-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                            @enderror

                            <div id="businessPreview" class="hidden mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-xs font-semibold text-blue-700 mb-2">
                                    <i class="fas fa-info-circle mr-1"></i> Preview usaha yang dipilih:
                                </p>
                                <div id="businessPreviewContent" class="text-xs text-gray-700"></div>
                            </div>

                            <button type="submit" id="assignButton" disabled
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2.5 rounded-xl transition text-sm shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-link mr-1"></i> Assign Usaha Ini
                            </button>
                        </form>
                    </details>
                    @else
                    <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg text-center">
                        <i class="fas fa-info-circle text-yellow-600 mr-1"></i>
                        <span class="text-xs text-yellow-700 font-medium">Semua usaha udah punya owner</span>
                    </div>
                    @endif
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

        // ============ DROPDOWN KATEGORI → NAMA USAHA (Assign) ============
        // Data: { "category_id": [ {id, name, label, category, address, phone}, ... ], ... }
        const assignBusinessData = {!! json_encode($businessesByCategory->mapWithKeys(function($items, $categoryId) {
            return [ (string) $categoryId => $items->map(function($biz) {
                return [
                    'id' => $biz->id,
                    'name' => $biz->name,
                    'label' => $biz->type ?: $biz->name,
                    'category' => $biz->category->name ?? 'Tanpa kategori',
                    'address' => $biz->address ?? '',
                    'phone' => $biz->phone ?? '',
                ];
            })->values() ];
        })->toArray()) !!};

        const assignCategorySelect = document.getElementById('assignCategorySelect');
        const assignBusinessSelect = document.getElementById('assignBusinessSelect');
        const assignButton = document.getElementById('assignButton');
        const businessPreview = document.getElementById('businessPreview');
        const businessPreviewContent = document.getElementById('businessPreviewContent');

        function updateAssignBusinesses() {
            const selectedCategoryId = assignCategorySelect.value;
            assignBusinessSelect.innerHTML = '';

            if (!selectedCategoryId) {
                assignBusinessSelect.innerHTML = '<option value="">-- Pilih Kategori Dulu --</option>';
                assignBusinessSelect.disabled = true;
                assignButton.disabled = true;
                businessPreview.classList.add('hidden');
                return;
            }

            // Pastiin key-nya string
            const businesses = assignBusinessData[String(selectedCategoryId)] || [];

            if (businesses.length === 0) {
                assignBusinessSelect.innerHTML = '<option value="">-- Gak ada usaha di kategori ini --</option>';
                assignBusinessSelect.disabled = true;
                assignButton.disabled = true;
                businessPreview.classList.add('hidden');
                return;
            }

            assignBusinessSelect.innerHTML = '<option value="">-- Pilih Nama Usaha --</option>';
            businesses.forEach(function(biz) {
                const option = document.createElement('option');
                option.value = biz.id;
                option.textContent = biz.label;
                option.dataset.bizInfo = JSON.stringify(biz);
                assignBusinessSelect.appendChild(option);
            });

            assignBusinessSelect.disabled = false;
            assignButton.disabled = true;
            businessPreview.classList.add('hidden');
        }

        function updateBusinessPreview() {
            const selectedOption = assignBusinessSelect.options[assignBusinessSelect.selectedIndex];

            if (!selectedOption || !selectedOption.value) {
                assignButton.disabled = true;
                businessPreview.classList.add('hidden');
                return;
            }

            const biz = JSON.parse(selectedOption.dataset.bizInfo);

            let html = `
                <div class="flex items-start gap-2">
                    <div class="w-6 h-6 rounded bg-blue-100 flex items-center justify-center shrink-0 mt-0.5">
                        <i class="fas fa-store text-blue-600 text-[10px]"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-800">${biz.label}</p>
                        <div class="flex flex-wrap items-center gap-1.5 mt-1">
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded">
                                <i class="fas fa-tag text-[8px]"></i> ${biz.category}
                            </span>
                            ${biz.address ? `<span class="inline-flex items-center gap-1 text-[10px] text-gray-500"><i class="fas fa-map-marker-alt text-[8px]"></i> ${biz.address}</span>` : ''}
                            ${biz.phone ? `<span class="inline-flex items-center gap-1 text-[10px] text-gray-500"><i class="fas fa-phone text-[8px]"></i> ${biz.phone}</span>` : ''}
                            <span class="text-[9px] font-mono text-gray-400 bg-gray-100 px-1.5 py-0.5 rounded">ID: ${biz.id}</span>
                        </div>
                    </div>
                </div>
            `;

            businessPreviewContent.innerHTML = html;
            businessPreview.classList.remove('hidden');
            assignButton.disabled = false;
        }

        assignCategorySelect?.addEventListener('change', updateAssignBusinesses);
        assignBusinessSelect?.addEventListener('change', updateBusinessPreview);
    </script>

</body>

</html>