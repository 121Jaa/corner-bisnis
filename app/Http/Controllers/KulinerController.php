<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Business;

class KulinerController extends Controller
{
    public function index()
    {
        $categories = Category::with('businesses')->get();
        $kuliner = Business::where('category_id', 2)->get();

        return view('kuliner', compact('categories', 'kuliner'));
    }

    public function warungMakan()
    {
        $categories = Category::with('businesses')->get();
        $kulinerWarungMakan = Business::where('category_id', 2)->where('name', 'Warung Makan')->get();

        return view('kuliner-warungMakan', compact('categories', 'kulinerWarungMakan'));
    }

    public function cafe()
    {
        $categories = Category::with('businesses')->get();
        $kulinerCafe = Business::where('category_id', 2)->where('name', 'Cafe')->get();

        return view('kuliner-Cafe', compact('categories', 'kulinerCafe'));
    }

    public function warmindo()
    {
        $categories = Category::with('businesses')->get();
        $kulinerWarmindo = Business::where('category_id', 2)->where('name', 'Warmindo')->get();

        return view('kuliner-Warmindo', compact('categories', 'kulinerWarmindo'));
    }

    public function show($id)
    {
        $business = Business::findOrFail($id);
        $categories = Category::with('businesses')->get();

        // Ambil semua kos dengan kategori yang sama, TAPI hanya yang namanya sama, dan kecuali kos yang sedang dibuka
        $relatedBusinesses = Business::where('category_id', $business->category_id)
            ->where('name', $business->name)
            ->where('id', '!=', $business->id)
            ->inRandomOrder()
            ->paginate(6);

        return view('business-detail', compact('business', 'categories', 'relatedBusinesses'));
    }
}
