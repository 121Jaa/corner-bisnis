<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Business;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('businesses')->get();
        $businesses = Business::latest()->take(3)->get();

        // Ambil SEMUA testimoni (jamak)
        $testimonials = \App\Models\Testimonial::all();

        // Data real-time untuk statistik
        $totalBusinesses = Business::count();
        $totalCategories = Category::count();

        return view('home', compact('categories', 'businesses', 'testimonials', 'totalBusinesses', 'totalCategories'));
    }

    public function allBusinesses()
    {
        // Tambahkan $categories di sini
        $categories = Category::with('businesses')->get();
        $businesses = Business::all();

        return view('all-businesses', compact('categories', 'businesses'));
    }

    public function showBusiness($id)
    {
        $business = Business::findOrFail($id);

        // Tambahkan $categories di sini juga biar navbar tetap jalan
        $categories = Category::with('businesses')->get();

        return view('business-detail', compact('business', 'categories'));
    }
}