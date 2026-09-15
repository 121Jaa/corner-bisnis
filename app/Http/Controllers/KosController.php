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

        // Ambil semua kos dengan kategori yang sama, TAPI hanya yang namanya sama, dan kecuali kos yang sedang dibuka
        $relatedBusinesses = Business::where('category_id', $business->category_id)
            ->where('name', $business->name)
            ->where('id', '!=', $business->id)
            ->get();

        return view('business-detail', compact('business', 'categories', 'relatedBusinesses'));
    }
}