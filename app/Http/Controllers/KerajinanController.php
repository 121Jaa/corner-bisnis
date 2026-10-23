<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Business;

class KerajinanController extends Controller
{
    // ⭐ Menu utama "Kerajinan"
    public function index()
    {
        $categories = Category::with('businesses')->get();

        // ⚠️ Ganti 6 dengan ID Kerajinan kamu
        $kerajinan = Business::where('category_id', 6)->get();

        return view('kerajinan', compact('categories', 'kerajinan'));
    }

    // ⭐ Submenu "Anyaman"
    public function anyaman()
    {
        $categories = Category::with('businesses')->get();

        $kerajinanAnyaman = Business::where('category_id', 6)
            ->where('name', 'Anyaman')
            ->get();

        return view('kerajinan-anyaman', compact('categories', 'kerajinanAnyaman'));
    }

    // ⭐ Submenu "Batik"
    public function batik()
    {
        $categories = Category::with('businesses')->get();

        $kerajinanBatik = Business::where('category_id', 6)
            ->where('name', 'Batik')
            ->get();

        return view('kerajinan-batik', compact('categories', 'kerajinanBatik'));
    }

    // ⭐ Submenu "Ukiran"
    public function ukiran()
    {
        $categories = Category::with('businesses')->get();

        $kerajinanUkiran = Business::where('category_id', 6)
            ->where('name', 'Ukiran')
            ->get();

        return view('kerajinan-ukiran', compact('categories', 'kerajinanUkiran'));
    }

    // ⭐ Detail usaha
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
}