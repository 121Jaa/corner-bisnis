<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Business;

class JasaController extends Controller
{
    public function index()
    {
        $categories = Category::with('businesses')->get();
        $jasa = Business::where('category_id', 4)->get();

        return view('jasa', compact('categories', 'jasa'));
    }

    public function travel()
    {
        $categories = Category::with('businesses')->get();
        $jasaTravel = Business::where('category_id', 4)->where('name', 'Travel')->get();

        return view('jasa-travel', compact('categories', 'jasaTravel'));
    }

    public function tukang()
    {
        $categories = Category::with('businesses')->get();
        $jasaTukang = Business::where('category_id', 4)->where('name', 'Tukang')->get();

        return view('jasa-Tukang', compact('categories', 'jasaTukang'));
    }

    public function cat()
    {
        $categories = Category::with('businesses')->get();
        $jasaCat = Business::where('category_id', 4)->where('name', 'Cat')->get();

        return view('jasa-Cat', compact('categories', 'jasaCat'));
    }

    public function sumur()
    {
        $categories = Category::with('businesses')->get();
        $jasaSumur = Business::where('category_id', 4)->where('name', 'Sumur')->get();

        return view('jasa-Sumur', compact('categories', 'jasaSumur'));
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
