<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Business;

class KosController extends Controller
{
    public function index()
    {
        $categories = Category::with('businesses')->get();
        $kos = Business::where('category_id', 1)->get();

        return view('kos', compact('categories', 'kos'));
    }

    public function putra()
    {
        $categories = Category::with('businesses')->get();
        $kosPutra = Business::where('category_id', 1)->where('name', 'Putra')->get();

        return view('kos-putra', compact('categories', 'kosPutra'));
    }

    public function putri()
    {
        $categories = Category::with('businesses')->get();
        $kosPutri = Business::where('category_id', 1)->where('name', 'Putri')->get();

        return view('kos-putri', compact('categories', 'kosPutri'));
    }

    public function show($id)
    {
        $business = Business::findOrFail($id);
        $categories = Category::with('businesses')->get();

        $relatedBusinesses = Business::where('category_id', $business->category_id)
            ->where('name', $business->name)
            ->where('id', '!=', $business->id)
            ->inRandomOrder()
            ->paginate(6);

        return view('business-detail', compact('business', 'categories', 'relatedBusinesses'));
    }

    public function showByCategory($slug)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();

        $businesses = \App\Models\Business::where('category_id', $category->id)
            ->with('category')
            ->inRandomOrder()
            ->paginate(9);

        // ⭐ Pilih view berdasarkan slug
        $viewName = match ($slug) {
            'kos' => 'kos',
            'kuliner' => 'kuliner',
            'laundry' => 'laundry',
            'jasa' => 'jasa',
            'toko' => 'toko',
            default => 'kategori',
        };

        // ⭐ Nama variabel yang dikirim ke view beda-beda
        $dataVar = match ($slug) {
            'kos' => 'kos',
            'kuliner' => 'kuliner',
            'laundry' => 'laundry',
            'jasa' => 'jasa',
            'toko' => 'toko',
            default => 'businesses',
        };

        return view($viewName, [
            'category' => $category,
            $dataVar => $businesses,
        ]);
    }
}
