<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Location;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Siswa dashboard
    public function index()
    {
        $user = auth()->user();

        $reports = Report::with(['facility', 'location'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('lialapo', compact('reports'));
    }

    public function create()
    {
        $locations = Location::orderBy('nama_lokasi')->get();
        $categories = Category::orderBy('nama_kategori')->get();

        return view('laporan.create', compact('locations', 'categories'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id',
            'deskripsi'   => 'required|string',
            'urgensi'     => 'required|in:normal,darurat',
            'foto'        => 'nullable|image|max:4096',
        ]);

        $user = Auth::user(); // Ambil data user yang login

        // 2. Mapping & Simpan Data
        $report = new Report();
        $report->location_id = $request->location_id;
        $report->facility_id = $request->category_id;
        $report->deskripsi   = $request->deskripsi;
        $report->urgensi     = $request->urgensi;
        $report->user_id     = $user->id;
        $report->status      = 'belum';

        // OTOMATISASI KELAS
        // Jika user adalah siswa, ambil class_id dari profil user mereka
        if ($user->role === 'siswa') {
            $report->class_id = $user->class_id;
        }

        // 3. Simpan Foto Jika Ada
        if ($request->hasFile('foto')) {
            $report->foto = $request->file('foto')->store('reports', 'public');
        }

        $report->save();

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Laporan berhasil dikirim! Tim kami akan segera menindaklanjuti.');
    }
}