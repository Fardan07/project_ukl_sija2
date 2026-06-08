<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Location;
use App\Models\Category; // 🌟 KITA PAKAI INI: Karena data TV, AC ada di sini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Siswa dashboard (Menampilkan Riwayat Histori Laporan)
    public function index()
    {
        $user = Auth::user();

        // Mengambil data report milik user yang sedang login beserta relasinya
        $reports = Report::with(['facility', 'location'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('lialapo', compact('reports'));
    }

    public function create()
    {
        $locations = Location::orderBy('nama_lokasi')->get();
        
        // 🔄 UBAH: Ambil data dari Category karena admin input AC, TV di menu Kategori Fasilitas
        $facilities = Category::orderBy('nama_kategori')->get(); 

        return view('landing', compact('locations', 'facilities'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'facility_id' => 'required|exists:categories,id', // 🔄 UBAH: Validasi wajib dicek ke tabel categories!
            'deskripsi'   => 'required|string',
            'urgensi'     => 'required|in:normal,darurat',
            'foto'        => 'nullable|image|max:4096',
        ]);

        $user = Auth::user(); 

        // 2. Mapping & Simpan Data
        $report = new Report();
        $report->location_id = $request->location_id;
        $report->facility_id = $request->facility_id; // Menyimpan ID kategori ke dalam kolom facility_id
        $report->deskripsi   = $request->deskripsi;
        $report->urgensi     = $request->urgensi;
        $report->user_id     = $user->id;
        $report->status      = 'belum'; // Status awal antrean baku

        // 3. Simpan Foto Jika Ada
        if ($request->hasFile('foto')) {
            $report->foto = $request->file('foto')->store('reports', 'public');
        }

        $report->save();

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Laporan berhasil dikirim! Tim kami akan segera menindaklanjuti.');
    }
}