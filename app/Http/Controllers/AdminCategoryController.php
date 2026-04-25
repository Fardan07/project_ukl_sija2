<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.kategori.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Category::create($request->all());
        return back()->with('success', 'Kategori fasilitas berhasil ditambahkan!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $category->update($request->all());
        return back()->with('success', 'Kategori fasilitas berhasil diupdate!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori fasilitas berhasil dihapus!');
    }
}