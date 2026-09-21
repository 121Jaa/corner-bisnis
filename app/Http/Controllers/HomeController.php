<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Business;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('businesses')->get();
        $businesses = Business::inRandomOrder()->take(6)->get();  // ⭐ 6 di homepage

        // Ambil SEMUA testimoni (jamak)
        $testimonials = \App\Models\Testimonial::all();

        // Data real-time untuk statistik
        $totalBusinesses = Business::count();
        $totalCategories = Category::count();

        return view('home', compact('categories', 'businesses', 'testimonials', 'totalBusinesses', 'totalCategories'));
    }

    public function allBusinesses()
    {
        $businesses = \App\Models\Business::with('category')
            ->inRandomOrder()
            ->paginate(9);  // ⭐ 9 per halaman di /usaha

        return view('all-businesses', compact('businesses'));
    }

    public function showBusiness($id)
    {
        $business = Business::findOrFail($id);

        // Tambahkan $categories di sini juga biar navbar tetap jalan
        $categories = Category::with('businesses')->get();

        return view('business-detail', compact('business', 'categories'));
    }
}