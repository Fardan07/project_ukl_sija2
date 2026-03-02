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

    public function dashboard()
    {
        $total = Report::count();
        $menunggu = Report::where('status','belum')->count();
        $proses = Report::where('status','proses')->count();
        $selesai = Report::where('status','selesai')->count();

        return view('admin.dashboard', compact('total','menunggu','proses','selesai'));
    }

    public function index()
    {
        $reports = Report::with(['user','facility','location'])->latest()->paginate(15);
        return view('admin.laporan.index', compact('reports'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:belum,proses,selesai',
            'catatan_admin' => 'nullable|string',
        ]);

        $report->status = $request->status;
        $report->catatan_admin = $request->catatan_admin;
        $report->save();

        return redirect()->back()->with('success', 'Status laporan diupdate.');
    }
}