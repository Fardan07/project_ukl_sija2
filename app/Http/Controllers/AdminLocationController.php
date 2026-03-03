<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class AdminLocationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role.admin']);
    }

    public function index()
    {
        $locations = Location::latest()->get();
        return view('admin.locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|max:255',
            'keterangan' => 'nullable|max:255',
        ]);

        Location::create($request->only('nama_lokasi','keterangan'));

        return back()->with('success','Lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'nama_lokasi' => 'required|max:255',
            'keterangan' => 'nullable|max:255',
        ]);

        $location->update($request->only('nama_lokasi','keterangan'));

        return back()->with('success','Lokasi berhasil diupdate.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return back()->with('success','Lokasi berhasil dihapus.');
    }
}