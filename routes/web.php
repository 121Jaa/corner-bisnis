<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\AdminBusinessController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $businesses = \App\Models\Business::with('category')->latest()->get();

        // Ambil data statistik
        $totalBusinesses = \App\Models\Business::count();
        $totalCategories = \App\Models\Category::count();

        return view('dashboard', compact('businesses', 'totalBusinesses', 'totalCategories'));
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Halaman Daftar Usaha
    Route::get('/daftarUsaha', function () {
        $businesses = \App\Models\Business::with('category')->latest()->get();
        return view('daftarUsaha', compact('businesses'));
    })->middleware(['auth', 'verified'])->name('daftarUsaha');

    Route::get('/admin/businesses/create', [AdminBusinessController::class, 'create'])->name('admin.businesses.create');

    Route::get('/tambahUsaha', function () {
        $categories = \App\Models\Category::all();

        // Ambil SEMUA data usaha (termasuk id, name, category_id)
        $businesses = \App\Models\Business::with('category')->get();

        return view('tambahUsaha', compact('categories', 'businesses'));
    })->middleware(['auth', 'verified'])->name('tambahUsaha');

    Route::post('/admin/categories', [AdminBusinessController::class, 'storeCategory'])->name('admin.categories.store');

    Route::get('/dashboard', function () {
        $businesses = \App\Models\Business::with('category')->latest()->get();

        // Ambil data statistik
        $totalBusinesses = \App\Models\Business::count();
        $totalCategories = \App\Models\Category::count();

        // Ambil jumlah usaha per kategori (untuk grafik)
        $businessesPerCategory = \App\Models\Business::selectRaw('category_id, count(*) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');

        $categories = \App\Models\Category::all();
        $categoryNames = $categories->pluck('name');
        $categoryCounts = $categories->map(fn($cat) => $businessesPerCategory[$cat->id] ?? 0);

        return view('dashboard', compact(
            'businesses',
            'totalBusinesses',
            'totalCategories',
            'categoryNames',
            'categoryCounts'
        ));
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/testimoni', function () {
        $testimonials = \App\Models\Testimonial::all();
        return view('testimoni', compact('testimonials'));
    })->middleware(['auth', 'verified'])->name('testimoni');

    Route::get('/testimoni/create', function () {
        return view('testimoni-create');
    })->middleware(['auth', 'verified'])->name('testimoni.create');

    Route::post('/testimoni', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
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
    })->middleware(['auth', 'verified'])->name('testimoni.store');

    Route::get('/testimoni/{id}/edit', function ($id) {
        $testimonial = \App\Models\Testimonial::findOrFail($id);
        return view('testimoni-edit', compact('testimonial'));
    })->middleware(['auth', 'verified'])->name('testimoni.edit');

    Route::put('/testimoni/{id}', function (\Illuminate\Http\Request $request, $id) {
        $testimonial = \App\Models\Testimonial::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'content' => 'required',
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
    })->middleware(['auth', 'verified'])->name('testimoni.update');

    Route::delete('/testimoni/{id}', function ($id) {
        $testimonial = \App\Models\Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->route('testimoni')->with('success', 'Testimoni berhasil dihapus!');
    })->middleware(['auth', 'verified'])->name('testimoni.destroy');

    // CRUD Admin
    Route::get('/admin/businesses', [AdminBusinessController::class, 'index'])->name('admin.businesses.index');
    Route::get('/admin/businesses/create', [AdminBusinessController::class, 'create'])->name('admin.businesses.create');
    Route::post('/admin/businesses', [AdminBusinessController::class, 'store'])->name('admin.businesses.store');
    Route::get('/admin/businesses/{id}/edit', [AdminBusinessController::class, 'edit'])->name('admin.businesses.edit');
    Route::put('/admin/businesses/{id}', [AdminBusinessController::class, 'update'])->name('admin.businesses.update');
    Route::delete('/admin/businesses/{id}', [AdminBusinessController::class, 'destroy'])->name('admin.businesses.destroy');
});

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
