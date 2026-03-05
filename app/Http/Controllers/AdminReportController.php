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
        $reports = Report::with(['user','facility','location'])
            ->latest()
            ->paginate(15);

        return view('admin.dashboard', compact('reports'));
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

public function destroy(Report $report)
{
    $report->delete();
    return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
}

public function show(Report $report)
{
    $report->load(['user','facility','location']);

    return view('admin.laporan.show', compact('report'));
}

}