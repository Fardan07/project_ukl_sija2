<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Category; // 🔄 UBAH: Gunakan model Category karena admin input data di sini
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('nama_lokasi')->get();
        
        // 🔄 UBAH: Ambil data dari tabel categories
        $facilities = Category::orderBy('nama_kategori')->get(); 

        return view('landing', compact('locations', 'facilities'));
    }
}