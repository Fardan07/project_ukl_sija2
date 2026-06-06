<?php

namespace App\Http\Controllers;

use App\Models\Report;

class AdminGrafikController extends Controller
{
    public function index()
   {
    $totalLaporan = Report::count();

    $laporanBulanIni = Report::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    return view('admin.grafik.index', compact(
        'totalLaporan',
        'laporanBulanIni'
    ));
   }
}