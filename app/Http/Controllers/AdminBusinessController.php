<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;

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
        $businesses = Business::select('name', 'category_id')->distinct()->get();

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
            'google_maps_link' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'facilities' => 'nullable|string',
            'image' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,avif'
        ]);

        $data = $request->all();
        unset($data['image']);

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

        Business::create($data);

        return redirect()->route('daftarUsaha')->with('success', 'Usaha berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $business = Business::findOrFail($id);
        $categories = Category::all();
        $businesses = Business::select('name', 'category_id')->distinct()->get();

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
            'google_maps_link' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'facilities' => 'nullable|string',
            'image' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,avif'
        ]);

        $data = $request->all();
        unset($data['image']);

        if (empty($data['type'])) {
            $data['type'] = $data['name'];
        }

        if ($request->hasFile('image')) {
            if ($business->image && $business->image != '1.avif' && file_exists(public_path('images/' . $business->image))) {
                unlink(public_path('images/' . $business->image));
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        $business->update($data);

        return redirect()->route('daftarUsaha')->with('success', 'Usaha berhasil diupdate!');
    }

    public function destroy($id)
    {
        $business = Business::findOrFail($id);

        // Hapus gambar jika ada dan bukan default
        if ($business->image && $business->image != '1.avif' && file_exists(public_path('images/' . $business->image))) {
            unlink(public_path('images/' . $business->image));
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
