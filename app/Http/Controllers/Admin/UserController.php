<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClassModel; // Pastikan nama model benar
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci dari form pencarian
        $search = $request->search;

        // Ambil data user beserta relasinya, dan filter jika ada pencarian
        $users = User::with(['class', 'position'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

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
            'class_id' => $request->class_id, // Boleh null kalau guru
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Update kolom position_id berdasarkan input dari dropdown
        $user->update([
            'position_id' => $request->position_id
        ]);

        return back()->with('success', 'Role ' . $user->name . ' berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }
}