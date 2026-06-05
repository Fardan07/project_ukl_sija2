<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClassModel; 
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\UsersImport; 
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        // Ganti ->get() menjadi ->paginate(10) untuk mengaktifkan halaman (10 data per halaman)
        $users = User::with(['class', 'position'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10) 
            ->withQueryString(); // Menjaga keyword pencarian tetap aktif saat pindah halaman

        $classes = ClassModel::all();
        $positions = Position::all();
        
        return view('admin.users.index', compact('users', 'classes', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'position_id' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position_id' => $request->position_id,
            'class_id' => $request->class_id, 
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
{
    // Validasi: Wajib dipilih dan harus ada di tabel positions
    $request->validate([
        'position_id' => 'required|exists:positions,id',
    ], [
        'position_id.required' => 'Pilih jabatan/role terlebih dahulu!',
        'position_id.exists'   => 'Data jabatan tidak valid!',
    ]);

    $user = User::findOrFail($id);
    
    $user->update([
        'position_id' => $request->position_id
    ]);

    return back()->with('success', 'Role ' . $user->name . ' berhasil diperbarui!');
}

    public function deleteAllStudents()
{
    try {
        // Hapus hanya yang ber-role 'siswa'
        User::where('role', 'siswa')->delete();
        
        return back()->with('success', 'Data siswa berhasil dikosongkan. Silakan upload data baru.');
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
    }
}

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }

    public function importExcel(Request $request)
    {
        set_time_limit(0);

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));
            return back()->with('success', 'Seluruh data akun berhasil diimpor dari Excel!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor file. Periksa format kolom. Detail: ' . $e->getMessage());
        }
    }
}