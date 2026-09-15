<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Business;

class TokoController extends Controller
{
    public function index()
    {
        $categories = Category::with('businesses')->get();
        $toko = Business::where('category_id', 5)->get();

        return view('toko', compact('categories', 'toko'));
    }

    public function plastik()
    {
        $categories = Category::with('businesses')->get();
        $tokoPlastik = Business::where('category_id', 5)->where('name', 'Plastik')->get();

        return view('toko-plastik', compact('categories', 'tokoPlastik'));
    }

    public function buah()
    {
        $categories = Category::with('businesses')->get();
        $tokoBuah = Business::where('category_id', 5)->where('name', 'Buah')->get();

        return view('toko-buah', compact('categories', 'tokoBuah'));
    }

    public function komputer()
    {
        $categories = Category::with('businesses')->get();
        $tokoKomputer = Business::where('category_id', 5)->where('name', 'Komputer')->get();

        return view('toko-komputer', compact('categories', 'tokoKomputer'));
    }

    public function kelontong()
    {
        $categories = Category::with('businesses')->get();
        $tokoKelontong = Business::where('category_id', 5)->where('name', 'Kelontong')->get();

        return view('toko-kelontong', compact('categories', 'tokoKelontong'));
    }

    public function show($id)
    {
        $business = Business::findOrFail($id);
        $categories = Category::with('businesses')->get();

        // Ambil semua kos dengan kategori yang sama, TAPI hanya yang namanya sama, dan kecuali kos yang sedang dibuka
        $relatedBusinesses = Business::where('category_id', $business->category_id)
            ->where('name', $business->name)
            ->where('id', '!=', $business->id)
            ->get();

        return view('business-detail', compact('business', 'categories', 'relatedBusinesses'));
    }   
}