<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Location;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    $reports = Report::with(['facility','location'])
        ->where('user_id', $user->id)
        ->latest()
        ->paginate(10);

    return view('dashboard', compact('reports'));
}

    public function create()
    {
        $locations = Location::orderBy('nama_lokasi')->get();
        $facilities = Facility::orderBy('nama_fasilitas')->get();

        return view('laporan.create', compact('locations','facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'facility_id' => 'required|exists:facilities,id',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|max:4096',
        ]);

        $data = $request->only(['location_id','facility_id','deskripsi']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('reports', 'public');
            $data['foto'] = $path;
        }

        $data['status'] = 'belum';

        Report::create($data);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dibuat.');
    }
}