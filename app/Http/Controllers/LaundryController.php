<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Business;

class LaundryController extends Controller
{
    public function index()
    {
        $categories = Category::with('businesses')->get();
        $laundry = Business::where('category_id', 3)->get();

        return view('laundry', compact('categories', 'laundry'));
    }

    public function laundry()
    {
        $categories = Category::with('businesses')->get();
        $laundry = Business::where('category_id', 3)->where('name', 'Laundry')->get();

        return view('laundry', compact('categories', 'laundry'));
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
