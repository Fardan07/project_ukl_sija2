<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'facility_id', // Ini akan otomatis kita isi pakai ID dari Kategori
        'location_id', // Ini akan otomatis kita isi pakai ID dari Lokasi
        'deskripsi', 
        'urgensi',     // Wajib masuk ke sini
        'foto', 
        'status', 
        'catatan_admin', 
        'foto_perbaikan', // Kolom baru untuk menyimpan foto perbaikan
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // RELASI DIARAHKAN KE CATEGORY (Tabel Kategori Baru)
    public function facility()
{
    return $this->belongsTo(Category::class, 'facility_id');
}

    public function location() 
    {
        return $this->belongsTo(Location::class);
    }
}