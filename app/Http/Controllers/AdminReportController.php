<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role.admin']);
    }

    // Fungsi untuk halaman Dashboard Admin
    public function dashboard()
    {
        $reports = Report::with(['user','facility','location'])
            ->latest()
            ->paginate(15);

        return view('admin.dashboard', compact('reports'));
    }

    // ==========================================
    // FUNGSI BARU: Untuk halaman Data Semua Laporan 
    // (Termasuk fitur Search & Sortir Urgensi)
    // ==========================================
    public function index(Request $request)
    {
        $search = $request->search;

        $reports = Report::with(['user', 'facility', 'location'])
            ->when($search, function ($query, $search) {
                // Pencarian berdasarkan nama pelapor atau isi deskripsi laporan
                return $query->whereHas('user', function ($q) use ($search) {
                                 $q->where('name', 'like', "%{$search}%");
                             })
                             ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            // LOGIKA PENGURUTAN: Yang 'darurat' ditaruh di urutan paling atas
            ->orderByRaw("CASE WHEN urgensi = 'darurat' THEN 1 ELSE 2 END")
            // Setelah itu, baru diurutkan berdasarkan laporan terbaru
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('reports'));
    }

    // Fungsi untuk update status (Proses / Selesai)
    public function updateStatus(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:belum,proses,selesai',
            'catatan_admin' => 'nullable|string',
        ]);

        $report->status = $request->status;
        $report->catatan_admin = $request->catatan_admin;
        $report->save();

        return redirect()->back()->with('success', 'Status laporan berhasil diupdate.');
    }

    // Fungsi Hapus (Tetap dibiarkan di controller untuk jaga-jaga, 
    // meski tombolnya sudah kita hilangkan di tampilan)
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }

    // Fungsi untuk melihat detail 1 laporan (View)
    public function show(Report $report)
    {
        $report->load(['user','facility','location']);

        return view('admin.laporan.show', compact('report'));
    }
}