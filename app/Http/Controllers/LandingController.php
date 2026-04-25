<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Memanggil model Kategori yang baru kita buat
use App\Models\Location; // Asumsi nama model Lokasi kamu adalah Location

class LandingController extends Controller
{
    public function index()
    {
        // Mengambil semua data kategori dan lokasi dari database
        $categories = Category::all();
        $locations = Location::all(); 

        // Mengirim data tersebut ke file landing.blade.php
        return view('landing', compact('categories', 'locations'));
    }
}