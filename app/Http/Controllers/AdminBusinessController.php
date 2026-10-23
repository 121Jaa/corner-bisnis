<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

class AdminBusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::with('category')->latest()->get();
        return view('admin.businesses.index', compact('businesses'));
    }

    public function create()
    {
        $categories = Category::all();
        $businesses = Business::select('id', 'name', 'type', 'category_id')->get();
        return view('admin.businesses.create', compact('categories', 'businesses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'phone' => 'nullable|string|max:20',
            'facilities' => 'nullable|string',
            'youtube_url' => 'nullable|string|max:255',
            'image' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,avif,webp,heic,heif',
            'images' => 'nullable|array|max:10',
            'images.*' => 'file|max:10240|mimes:jpg,jpeg,png,avif,webp,heic,heif',
        ]);

        $data = $request->except(['image', 'images', '_token', '_method']);

        if (!empty($data['latitude']) && !empty($data['longitude'])) {
            $data['google_maps_link'] = "https://www.google.com/maps?q={$data['latitude']},{$data['longitude']}";
        }

        if (empty($data['type'])) {
            $data['type'] = $data['name'];
        }

        // Cover
        if ($request->hasFile('image')) {
            $filename = ImageHelper::uploadAndConvert($request->file('image'), 'images', 1920, 82);
            $data['image'] = $filename;
        } else {
            $data['image'] = '1.avif';
        }

        // Galeri
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file) continue;
                $filename = ImageHelper::uploadAndConvert($file, 'images', 1600, 85);
                $images[] = 'images/' . $filename;
            }
        }
        $data['images'] = $images;

        Business::create($data);

        return redirect()->route('daftarUsaha')->with('success', 'Usaha berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $business = Business::findOrFail($id);
        $categories = Category::all();
        $businesses = Business::select('id', 'name', 'type', 'category_id')->get();
        return view('admin.businesses.edit', compact('business', 'categories', 'businesses'));
    }

    public function update(Request $request, $id)
    {
        $business = Business::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'phone' => 'nullable|string|max:20',
            'facilities' => 'nullable|string',
            'youtube_url' => 'nullable|string|max:255',
            'image' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,avif,webp,heic,heif',
            'images' => 'nullable|array|max:10',
            'images.*' => 'file|max:10240|mimes:jpg,jpeg,png,avif,webp,heic,heif',
        ]);

        $data = $request->except(['image', 'images', 'remove_images', '_token', '_method']);

        if (!empty($data['latitude']) && !empty($data['longitude'])) {
            $data['google_maps_link'] = "https://www.google.com/maps?q={$data['latitude']},{$data['longitude']}";
        }

        if (empty($data['type'])) {
            $data['type'] = $data['name'];
        }

        // ⭐ Cover (udah bener)
        if ($request->hasFile('image')) {
            if ($business->image && $business->image != '1.avif' && file_exists(public_path('images/' . $business->image))) {
                @unlink(public_path('images/' . $business->image));
            }
            $filename = ImageHelper::uploadAndConvert($request->file('image'), 'images', 1920, 82);
            $data['image'] = $filename;
        }

        // Galeri — ambil yang lama
        $currentImages = $business->images;
        if (!is_array($currentImages)) {
            $currentImages = [];
        }

        // Filter yang lama — cuma yang masih ada filenya
        $currentImages = array_values(array_filter($currentImages, function ($img) {
            return is_string($img) && $img !== '' && file_exists(public_path($img));
        }));

        // Hapus yang dicentang
        if ($request->has('remove_images')) {
            foreach ((array) $request->remove_images as $imgPath) {
                if (!is_string($imgPath)) continue;
                if (file_exists(public_path($imgPath))) {
                    @unlink(public_path($imgPath));
                }
                $currentImages = array_values(array_filter($currentImages, fn($i) => $i !== $imgPath));
            }
        }

        // ⭐ Tambah gambar baru (udah bener pake Helper)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if (!$file) continue;
                $filename = ImageHelper::uploadAndConvert($file, 'images', 1600, 85);
                $currentImages[] = 'images/' . $filename;
            }
        }

        $currentImages = array_slice($currentImages, 0, 10);
        $data['images'] = $currentImages;

        $business->update($data);

        return redirect()->route('daftarUsaha')->with('success', 'Usaha berhasil diupdate!');
    }

    public function destroy($id)
    {
        $business = Business::findOrFail($id);

        if ($business->image && $business->image != '1.avif' && file_exists(public_path('images/' . $business->image))) {
            @unlink(public_path('images/' . $business->image));
        }

        // Hapus galeri
        $images = $business->images;
        if (is_array($images)) {
            foreach ($images as $img) {
                if (is_string($img) && file_exists(public_path($img))) {
                    @unlink(public_path($img));
                }
            }
        }

        $business->delete();
        return redirect()->route('daftarUsaha')->with('success', 'Usaha berhasil dihapus!');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories|max:255'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return redirect()->route('dashboard')->with('success', 'Kategori berhasil ditambahkan!');
    }
}