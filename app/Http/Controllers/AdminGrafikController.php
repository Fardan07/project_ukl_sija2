<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Facades\DB;

class AdminGrafikController extends Controller
{
    public function index()
    {
        // 1. Hitung Ringkasan Data Utama
        $laporanBulanIni = Report::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $laporanSelesai = Report::where('status', 'selesai')->count();
        
        // 🔄 PERBAIKAN: Diubah dari 'diproses' menjadi 'proses' agar sinkron dengan AdminReportController
        $laporanDiproses = Report::where('status', 'proses')->count();
        
        // Menghitung total laporan nyata (menghindari pembagian nol pada persentase)
        $totalLaporan = Report::count();

        // 2. Hitung Persentase Status
        $persenSelesai = $totalLaporan > 0 ? round(($laporanSelesai / $totalLaporan) * 100, 1) : 0;
        $persenDiproses = $totalLaporan > 0 ? round(($laporanDiproses / $totalLaporan) * 100, 1) : 0;

        // 3. Ambil Data Bulanan Untuk Grafik Bar (Dialek MySQL Fix)
        $dataBulanan = Report::select(
            DB::raw("DATE_FORMAT(created_at, '%m') as bulan"), 
            DB::raw('count(*) as total')
        )
        ->groupBy('bulan')
        ->pluck('total', 'bulan')
        ->toArray();

        $dataBulananFix = [];
        for ($i = 1; $i <= 12; $i++) {
            $key = str_pad($i, 2, '0', STR_PAD_LEFT); // Menghasilkan '01', '02', dst.
            $dataBulananFix[] = $dataBulanan[$key] ?? 0;
        }

        // 4. Ambil 5 Kategori Kerusakan Terbanyak (Menyesuaikan kolom facility_id)
        $topKategori = Report::select(
                'facility_id', 
                DB::raw('count(*) as total')
            )
            ->with('facility') // Menggunakan relasi resmi ke model Category
            ->groupBy('facility_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $maksimalLaporan = $topKategori->first() ? $topKategori->first()->total : 1;

        // 5. Kembalikan ke View
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