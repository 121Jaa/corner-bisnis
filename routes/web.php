<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\AdminBusinessController;
use Illuminate\Support\Facades\Route;

// ==================== PUBLIC ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/usaha', [HomeController::class, 'allBusinesses'])->name('all-businesses');

Route::get('/kos', [KosController::class, 'index'])->name('kos');
Route::get('/kos/putra', [KosController::class, 'putra'])->name('kos.putra');
Route::get('/kos/putri', [KosController::class, 'putri'])->name('kos.putri');
Route::get('/kos/{id}', [KosController::class, 'show'])->name('kos.show');

// Rute Kuliner
Route::get('/kuliner', [KulinerController::class, 'index'])->name('kuliner');
Route::get('/kuliner/warung-makan', [KulinerController::class, 'warungMakan'])->name('kuliner.warungMakan');
Route::get('/kuliner/cafe', [KulinerController::class, 'cafe'])->name('kuliner.cafe');
Route::get('/kuliner/warmindo', [KulinerController::class, 'warmindo'])->name('kuliner.warmindo');
Route::get('/kuliner/{id}', [KulinerController::class, 'show'])->name('kuliner.show');

// Rute Laundry
Route::get('/laundry', [LaundryController::class, 'index'])->name('laundry');
Route::get('/laundry/{id}', [LaundryController::class, 'show'])->name('laundry.show');

// Rute Jasa
Route::get('/jasa', [JasaController::class, 'index'])->name('jasa');
Route::get('/jasa/travel', [JasaController::class, 'travel'])->name('jasa.travel');
Route::get('/jasa/tukang', [JasaController::class, 'tukang'])->name('jasa.tukang');
Route::get('/jasa/cat', [JasaController::class, 'cat'])->name('jasa.cat');
Route::get('/jasa/sumur', [JasaController::class, 'sumur'])->name('jasa.sumur');
Route::get('/jasa/{id}', [JasaController::class, 'show'])->name('jasa.show');

// Rute Toko
Route::get('/toko', [TokoController::class, 'index'])->name('toko');
Route::get('/toko/plastik', [TokoController::class, 'plastik'])->name('toko.plastik');
Route::get('/toko/buah', [TokoController::class, 'buah'])->name('toko.buah');
Route::get('/toko/komputer', [TokoController::class, 'komputer'])->name('toko.komputer');
Route::get('/toko/kelontong', [TokoController::class, 'kelontong'])->name('toko.kelontong');
Route::get('/toko/{id}', [TokoController::class, 'show'])->name('toko.show');

// ==================== ADMIN ROUTES (PROTECTED) ====================
Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    // ---------- Dashboard ----------
    Route::get('/dashboard', function () {
        $businesses = \App\Models\Business::with('category')->latest()->get();

        $totalBusinesses = \App\Models\Business::count();
        $totalCategories = \App\Models\Category::count();

        $businessesPerCategory = \App\Models\Business::selectRaw('category_id, count(*) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');

        $categories = \App\Models\Category::all();
        $categoryNames = $categories->pluck('name');
        $categoryCounts = $categories->map(fn($cat) => $businessesPerCategory[$cat->id] ?? 0);

        return view('admin.businesses.dashboard', compact(
            'businesses',
            'totalBusinesses',
            'totalCategories',
            'categoryNames',
            'categoryCounts'
        ));
    })->name('dashboard');

    // ---------- Daftar Usaha ----------
    Route::get('/daftarUsaha', function () {
        $businesses = \App\Models\Business::with('category')->latest()->get();
        return view('admin.businesses.index', compact('businesses'));
    })->name('daftarUsaha');

    // ---------- Tambah Usaha ----------
    Route::get('/tambahUsaha', function () {
        $categories = \App\Models\Category::all();
        $businesses = \App\Models\Business::with('category')->get();
        return view('admin.businesses.tambahUsaha', compact('categories', 'businesses'));
    })->name('tambahUsaha');

    // ---------- Kategori ----------
    Route::post('/admin/categories', [AdminBusinessController::class, 'storeCategory'])->name('admin.categories.store');

    // ---------- Testimoni ----------
    Route::get('/testimoni', function () {
        $testimonials = \App\Models\Testimonial::all();
        return view('admin.businesses.testimoni', compact('testimonials'));
    })->name('testimoni');

    Route::get('/testimoni/create', function () {
        return view('admin.businesses.testimoni-create');
    })->name('testimoni.create');

    Route::post('/testimoni', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|file|max:2048'
        ]);

        $data = $request->all();
        unset($data['image']);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        \App\Models\Testimonial::create($data);

        return redirect()->route('testimoni')->with('success', 'Testimoni berhasil ditambahkan!');
    })->name('testimoni.store');

    Route::get('/testimoni/{id}/edit', function ($id) {
        $testimonial = \App\Models\Testimonial::findOrFail($id);
        return view('admin.businesses.testimoni-edit', compact('testimonial'));
    })->name('testimoni.edit');

    Route::put('/testimoni/{id}', function (\Illuminate\Http\Request $request, $id) {
        $testimonial = \App\Models\Testimonial::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|file|max:2048'
        ]);

        $data = $request->all();
        unset($data['image']);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        $testimonial->update($data);

        return redirect()->route('testimoni')->with('success', 'Testimoni berhasil diupdate!');
    })->name('testimoni.update');

    Route::delete('/testimoni/{id}', function ($id) {
        $testimonial = \App\Models\Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->route('testimoni')->with('success', 'Testimoni berhasil dihapus!');
    })->name('testimoni.destroy');

    // ========== CRUD USER (ADMIN) ==========
    Route::prefix('admin/users')->name('admin.users.')->group(function () {

        Route::get('/', function () {
            $users = \App\Models\User::orderBy('role')->orderBy('name')->get();
            return view('admin.users.index', compact('users'));
        })->name('index');

        Route::get('/create', function () {
            return view('admin.users.create');
        })->name('create');

        Route::post('/', function (\Illuminate\Http\Request $request) {
            $request->validate([
                'name' => 'required|string|max:255|unique:users,name',
                'display_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'required|in:admin,user',
                'is_active' => 'boolean',
            ]);

            \App\Models\User::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
                'is_active' => $request->is_active ?? true,
            ]);

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil ditambahkan!');
        })->name('store');

        Route::get('/generate-password', function () {
            $password = \Illuminate\Support\Str::random(10);
            return response()->json(['password' => $password]);
        })->name('generatePassword');

        Route::post('/{id}/assign-business', [\App\Http\Controllers\Admin\UserBusinessController::class, 'assign'])
            ->name('assign-business');

        Route::delete('/{id}/unassign-business/{businessId}', [\App\Http\Controllers\Admin\UserBusinessController::class, 'unassign'])
            ->name('unassign-business');

        Route::get('/{id}/edit', function ($id) {
            $user = \App\Models\User::findOrFail($id);
            return view('admin.users.edit', compact('user'));
        })->name('edit');

        Route::put('/{id}', function (\Illuminate\Http\Request $request, $id) {
            $user = \App\Models\User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|unique:users,name,' . $id,
                'display_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:6',
                'role' => 'required|in:admin,user',
                'is_active' => 'boolean',
            ]);

            $data = [
                'name' => $request->name,
                'display_name' => $request->display_name,
                'email' => $request->email,
                'role' => $request->role,
                'is_active' => $request->is_active ?? true,
            ];

            if ($request->filled('password')) {
                $data['password'] = $request->password;
            }

            $user->update($data);

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil diupdate!');
        })->name('update');

        Route::delete('/{id}', function ($id) {
            $user = \App\Models\User::findOrFail($id);

            if ($user->id === auth()->id()) {
                return back()->with('error', 'Kamu tidak bisa menghapus akun sendiri.');
            }

            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil dihapus!');
        })->name('destroy');
    });

    // ---------- CRUD Usaha (Admin) ----------
    Route::get('/admin/businesses', [AdminBusinessController::class, 'index'])->name('admin.businesses.index');
    Route::get('/admin/businesses/create', [AdminBusinessController::class, 'create'])->name('admin.businesses.create');
    Route::post('/admin/businesses', [AdminBusinessController::class, 'store'])->name('admin.businesses.store');
    Route::get('/admin/businesses/{id}/edit', [AdminBusinessController::class, 'edit'])->name('admin.businesses.edit');
    Route::put('/admin/businesses/{id}', [AdminBusinessController::class, 'update'])->name('admin.businesses.update');
    Route::delete('/admin/businesses/{id}', [AdminBusinessController::class, 'destroy'])->name('admin.businesses.destroy');

    // ⭐ HAPUS GALERI PER GAMBAR (ADMIN)
    Route::delete('/admin/businesses/{id}/remove-image', function (\Illuminate\Http\Request $request, $id) {
        $business = \App\Models\Business::findOrFail($id);

        $imgPath = trim((string) $request->image_path);
        if ($imgPath === '') {
            return back()->with('error', 'Gambar tidak valid.');
        }

        // Hapus file
        $paths = [
            public_path($imgPath),
            public_path('images/' . basename($imgPath)),
        ];
        foreach ($paths as $path) {
            if (file_exists($path)) {
                @unlink($path);
                break;
            }
        }

        // Hapus dari array
        $current = $business->images;
        if (!is_array($current)) $current = [];
        $current = array_values(array_filter($current, function($i) use ($imgPath) {
            return trim((string) $i) !== $imgPath;
        }));

        $business->images = $current;
        $business->save();

        return back()->with('success', 'Gambar berhasil dihapus!');
    })->name('admin.businesses.remove-image');

    // ---------- KONTEN WEB (DINAMIS) ----------
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/hero', function () {
            $heroImages = \App\Models\SiteContent::getJson('hero_slides', []);
            return view('admin.hero.index', compact('heroImages'));
        })->name('hero');

        Route::post('/hero/text', function (\Illuminate\Http\Request $request) {
            \App\Models\SiteContent::set('hero_badge', $request->hero_badge);
            \App\Models\SiteContent::set('hero_title', $request->hero_title);
            \App\Models\SiteContent::set('hero_subtitle', $request->hero_subtitle);

            \App\Models\SiteContent::set('navbar_logo_type', $request->navbar_logo_type ?? 'text');
            \App\Models\SiteContent::set('navbar_logo_text', $request->navbar_logo_text ?? 'RT 04');

            if ($request->hasFile('navbar_logo_image')) {
                $oldLogo = \App\Models\SiteContent::get('navbar_logo_image');
                if ($oldLogo && file_exists(public_path($oldLogo))) {
                    @unlink(public_path($oldLogo));
                }

                $file = $request->file('navbar_logo_image');
                $filename = time() . '_logo_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                \App\Models\SiteContent::set('navbar_logo_image', 'images/' . $filename, 'image');
            }

            return back()->with('success', 'Text hero & Logo navbar berhasil diupdate!');
        })->name('hero.text');

        Route::post('/hero/add', function (\Illuminate\Http\Request $request) {
            $request->validate([
                'image' => 'required|image|max:2048'
            ]);

            $heroImages = \App\Models\SiteContent::getJson('hero_slides', []);

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $heroImages[] = 'images/' . $filename;

            \App\Models\SiteContent::set('hero_slides', json_encode($heroImages), 'json');

            return back()->with('success', 'Gambar berhasil ditambahkan!');
        })->name('hero.add');

        Route::post('/hero/remove', function (\Illuminate\Http\Request $request) {
            $heroImages = \App\Models\SiteContent::getJson('hero_slides', []);
            $index = (int) $request->index;

            if (isset($heroImages[$index])) {
                $filePath = public_path($heroImages[$index]);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
                unset($heroImages[$index]);
                $heroImages = array_values($heroImages);
                \App\Models\SiteContent::set('hero_slides', json_encode($heroImages), 'json');
            }

            return back()->with('success', 'Gambar berhasil dihapus!');
        })->name('hero.remove');

        Route::post('/business-text', function (\Illuminate\Http\Request $request) {
            \App\Models\SiteContent::set('business_label', $request->business_label);
            \App\Models\SiteContent::set('business_title', $request->business_title);
            \App\Models\SiteContent::set('business_subtitle', $request->business_subtitle);
            \App\Models\SiteContent::set('business_view_detail', $request->business_view_detail);
            \App\Models\SiteContent::set('business_view_all_button', $request->business_view_all_button);
            \App\Models\SiteContent::set('business_empty', $request->business_empty);

            return back()->with('success', 'Text Daftar Usaha berhasil diupdate!');
        })->name('business.text');

        Route::post('/testimonial-text', function (\Illuminate\Http\Request $request) {
            \App\Models\SiteContent::set('testimonial_label', $request->testimonial_label);
            \App\Models\SiteContent::set('testimonial_title', $request->testimonial_title);
            \App\Models\SiteContent::set('testimonial_subtitle', $request->testimonial_subtitle);
            \App\Models\SiteContent::set('testimonial_empty', $request->testimonial_empty);

            return back()->with('success', 'Text Testimoni berhasil diupdate!');
        })->name('testimonial.text');

        Route::get('/about', function () {
            return view('admin.about.index');
        })->name('about');

        Route::post('/about', function (\Illuminate\Http\Request $request) {
            \App\Models\SiteContent::set('about_label', $request->about_label);
            \App\Models\SiteContent::set('about_title', $request->about_title);
            \App\Models\SiteContent::set('about_subtitle', $request->about_subtitle);
            \App\Models\SiteContent::set('about_desc_1', $request->about_desc_1);
            \App\Models\SiteContent::set('about_desc_2', $request->about_desc_2);

            if ($request->hasFile('about_image')) {
                $file = $request->file('about_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                \App\Models\SiteContent::set('about_image', 'images/' . $filename, 'image');
            }

            return back()->with('success', 'Tentang Kami berhasil diupdate!');
        })->name('about.store');

        Route::get('/stats', function () {
            return view('admin.stats.index');
        })->name('stats');

        Route::post('/stats', function (\Illuminate\Http\Request $request) {
            \App\Models\SiteContent::set('stat_access', $request->stat_access);
            \App\Models\SiteContent::set('stat_access_label', $request->stat_access_label);
            \App\Models\SiteContent::set('stat_helped', $request->stat_helped);
            \App\Models\SiteContent::set('stat_helped_label', $request->stat_helped_label);
            \App\Models\SiteContent::set('stat_business_label', $request->stat_business_label);
            \App\Models\SiteContent::set('stat_category_label', $request->stat_category_label);
            return back()->with('success', 'Statistik berhasil diupdate!');
        })->name('stats.store');

        Route::get('/contact', function () {
            return view('admin.contact.index');
        })->name('contact');

        Route::post('/contact', function (\Illuminate\Http\Request $request) {
            \App\Models\SiteContent::set('contact_address', $request->contact_address);
            \App\Models\SiteContent::set('contact_phone', $request->contact_phone);
            \App\Models\SiteContent::set('contact_email', $request->contact_email);
            \App\Models\SiteContent::set('contact_whatsapp', $request->contact_whatsapp);

            \App\Models\SiteContent::set('cta_title', $request->cta_title);
            \App\Models\SiteContent::set('cta_desc', $request->cta_desc);
            \App\Models\SiteContent::set('cta_button', $request->cta_button);

            \App\Models\SiteContent::set('footer_title', $request->footer_title);
            \App\Models\SiteContent::set('footer_desc', $request->footer_desc);
            \App\Models\SiteContent::set('footer_nav_title', $request->footer_nav_title);
            \App\Models\SiteContent::set('footer_contact_title', $request->footer_contact_title);
            \App\Models\SiteContent::set('footer_nav_home', $request->footer_nav_home);
            \App\Models\SiteContent::set('footer_nav_business', $request->footer_nav_business);
            \App\Models\SiteContent::set('footer_nav_register', $request->footer_nav_register);
            \App\Models\SiteContent::set('footer_nav_about', $request->footer_nav_about);
            \App\Models\SiteContent::set('footer_copyright', $request->footer_copyright);

            return back()->with('success', 'Kontak & Footer berhasil diupdate!');
        })->name('contact.store');
    });
});

// ==================== USER ROUTES (PEMILIK USAHA) ====================
Route::middleware(['auth', 'verified', 'user'])->prefix('user')->name('user.')->group(function () {

    Route::get('/dashboard', function () {
        $businesses = \App\Models\Business::where('user_id', auth()->id())
            ->with('category')
            ->latest()
            ->get();

        $totalBusinesses = $businesses->count();
        $totalCategories = $businesses->pluck('category_id')->unique()->count();

        return view('user.dashboard', compact('businesses', 'totalBusinesses', 'totalCategories'));
    })->name('dashboard');

    Route::get('/businesses', function () {
        $businesses = \App\Models\Business::where('user_id', auth()->id())
            ->with('category')
            ->latest()
            ->get();

        return view('user.businesses.index', compact('businesses'));
    })->name('businesses.index');

    Route::get('/businesses/create', function () {
        $categories = \App\Models\Category::all();
        $businesses = \App\Models\Business::select('id', 'name', 'type', 'category_id')->get();
        return view('user.businesses.create', compact('categories', 'businesses'));
    })->name('businesses.create');

    Route::post('/businesses', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'google_maps_link' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'facilities' => 'nullable|string',
            'image' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,avif,webp',
            'images' => 'nullable|array|max:10',
            'images.*' => 'file|max:2048|mimes:jpg,jpeg,png,avif,webp',
        ]);

        $data = $request->except(['image', 'images', 'remove_images', '_token', '_method']);
        $data['user_id'] = auth()->id();

        if (empty($data['type'])) {
            $data['type'] = $data['name'];
        }

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $data['image'] = $filename;
        } else {
            $data['image'] = '1.avif';
        }

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file) continue;
                if (!$file instanceof \Illuminate\Http\UploadedFile) continue;
                if (!$file->isValid()) continue;

                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $images[] = 'images/' . $filename;
            }
        }
        $data['images'] = $images;

        \App\Models\Business::create($data);

        return redirect()->route('user.businesses.index')
            ->with('success', 'Usaha berhasil ditambahkan!');
    })->name('businesses.store');

    Route::get('/businesses/{id}/edit', function ($id) {
        $business = \App\Models\Business::where('user_id', auth()->id())
            ->findOrFail($id);

        $categories = \App\Models\Category::all();
        $businesses = \App\Models\Business::select('id', 'name', 'type', 'category_id')->get();

        return view('user.businesses.edit', compact('business', 'categories', 'businesses'));
    })->name('businesses.edit');

    Route::put('/businesses/{id}', function (\Illuminate\Http\Request $request, $id) {
        $business = \App\Models\Business::where('user_id', auth()->id())
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'google_maps_link' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'facilities' => 'nullable|string',
            'image' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,avif,webp',
            'images' => 'nullable|array|max:10',
            'images.*' => 'file|max:2048|mimes:jpg,jpeg,png,avif,webp',
        ]);

        $data = $request->except(['image', 'images', 'remove_images', '_token', '_method']);

        if (empty($data['type'])) {
            $data['type'] = $data['name'];
        }

        if ($request->hasFile('image')) {
            if ($business->image && $business->image != '1.avif' && file_exists(public_path('images/' . $business->image))) {
                @unlink(public_path('images/' . $business->image));
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        $currentImages = $business->images;
        if (!is_array($currentImages)) {
            $currentImages = [];
        }

        $currentImages = array_values(array_filter($currentImages, function($img) {
            return is_string($img) && $img !== '' && file_exists(public_path($img));
        }));

        if ($request->has('remove_images')) {
            foreach ((array) $request->remove_images as $imgPath) {
                if (!is_string($imgPath)) continue;
                if (file_exists(public_path($imgPath))) {
                    @unlink(public_path($imgPath));
                }
                $currentImages = array_values(array_filter($currentImages, fn($i) => $i !== $imgPath));
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file) continue;
                if (!$file instanceof \Illuminate\Http\UploadedFile) continue;
                if (!$file->isValid()) continue;

                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $currentImages[] = 'images/' . $filename;
            }
        }

        $currentImages = array_slice($currentImages, 0, 10);
        $data['images'] = $currentImages;

        $business->update($data);

        return redirect()->route('user.businesses.index')
            ->with('success', 'Usaha berhasil diupdate!');
    })->name('businesses.update');

    Route::delete('/businesses/{id}', function ($id) {
        $business = \App\Models\Business::where('user_id', auth()->id())
            ->findOrFail($id);

        if ($business->image && $business->image != '1.avif' && file_exists(public_path('images/' . $business->image))) {
            @unlink(public_path('images/' . $business->image));
        }

        $images = $business->images;
        if (is_array($images)) {
            foreach ($images as $img) {
                if (is_string($img) && file_exists(public_path($img))) {
                    @unlink(public_path($img));
                }
            }
        }

        $business->delete();

        return redirect()->route('user.businesses.index')
            ->with('success', 'Usaha berhasil dihapus!');
    })->name('businesses.destroy');

        // ⭐ HAPUS GALERI PER GAMBAR (USER)
    Route::delete('/businesses/{id}/remove-image', function (\Illuminate\Http\Request $request, $id) {
        $business = \App\Models\Business::where('user_id', auth()->id())
            ->findOrFail($id);

        $imgPath = trim((string) $request->image_path);
        if ($imgPath === '') {
            return back()->with('error', 'Gambar tidak valid.');
        }

        // Hapus file
        $paths = [
            public_path($imgPath),
            public_path('images/' . basename($imgPath)),
        ];
        foreach ($paths as $path) {
            if (file_exists($path)) {
                @unlink($path);
                break;
            }
        }

        // Hapus dari array
        $current = $business->images;
        if (!is_array($current)) $current = [];
        $current = array_values(array_filter($current, function($i) use ($imgPath) {
            return trim((string) $i) !== $imgPath;
        }));

        $business->images = $current;
        $business->save();

        return back()->with('success', 'Gambar berhasil dihapus!');
    })->name('businesses.remove-image');
});

// ==================== LOGOUT ====================
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')->with('success', 'Kamu berhasil logout!');
})->name('logout');

Route::get('/redirect-after-login', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->isAdmin()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('user.dashboard');
})->name('redirect.after.login');

Route::get('/kategori/{slug}', [App\Http\Controllers\KosController::class, 'showByCategory'])
    ->name('category.show');

Route::get('/geocode/search', function (\Illuminate\Http\Request $request) {
    $q = $request->query('q');
    if (!$q) return response()->json([]);

    $url = 'https://nominatim.openstreetmap.org/search?format=json&q=' . urlencode($q) . '&limit=5&accept-language=id';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'CornerBisnisRT04/1.0 (cornerbisnis@gmail.com)');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return response($response, 200)->header('Content-Type', 'application/json');
})->name('geocode.search');

require __DIR__ . '/settings.php';