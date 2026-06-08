<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Facades\DB;

class AdminGrafikController extends Controller
{
    public function index()
   {
    $totalLaporan = Report::count();

    $laporanBulanIni = Report::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    $laporanSelesai = Report::where('status', 'selesai')->count();
    $laporanDiproses = Report::where('status', 'diproses')->count();

    $dataBulanan = Report::select(
        DB::raw("strftime('%m', created_at) as bulan"), 
        DB::raw('count(*) as total')
    )
    ->groupBy('bulan')
    ->pluck('total', 'bulan')
    ->toArray();

$dataBulananFix = [];

for ($i = 1; $i <= 12; $i++) {
    $key = str_pad($i, 2, '0', STR_PAD_LEFT);
    $dataBulananFix[] = $dataBulanan[$key] ?? 0;
}

    $totalLaporan = $laporanSelesai + $laporanDiproses;

    $persenSelesai = $totalLaporan > 0 ? round(($laporanSelesai / $totalLaporan) * 100, 1) : 0;
    $persenDiproses = $totalLaporan > 0 ? round(($laporanDiproses / $totalLaporan) * 100, 1) : 0;


    $topKategori = \App\Models\Report::select(
            'category_id', 
            \DB::raw('count(*) as total')
        )
        ->with('category') 
        ->groupBy('category_id')
        ->orderBy('total', 'desc')
        ->take(5)
        ->get();

    $maksimalLaporan = $topKategori->first() ? $topKategori->first()->total : 1;

    return view('admin.grafik.index', compact(
        'totalLaporan',
        'laporanBulanIni',
        'laporanSelesai',
        'laporanDiproses',
        'dataBulananFix',
        'persenSelesai',
        'persenDiproses',
        'topKategori',
        'maksimalLaporan'
    ));
   }
}