<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // 1. Bersihkan nama kolom (agar "Kelas" atau "Kelas Baru" bisa dibaca)
        $cleanRow = [];
        foreach ($row as $key => $value) {
            $cleanKey = Str::slug(trim($key), '_');
            $cleanRow[$cleanKey] = $value;
        }

        // ... di dalam fungsi model(array $row) ...

// Mapping data
$nama        = $cleanRow['nama'] ?? $cleanRow['nama_siswa'] ?? null;
$usernameLms = $cleanRow['username_mylms'] ?? $cleanRow['username_my_lms'] ?? null;
$passwordLms = $cleanRow['password_mylms'] ?? $cleanRow['password_my_lms'] ?? 'Skomda123@';
$kelas       = $cleanRow['kelas'] ?? $cleanRow['kelas_baru'] ?? null;

// BERSIHKAN FORMAT .0 DARI EXCEL (Baris ini kuncinya!)
$usernameClean = str_replace('.0', '', (string)$usernameLms);

if (empty($nama) || empty($usernameLms)) {
    return null;
}

return User::updateOrCreate(
    ['email' => trim($usernameClean)], // Pakai hasil pembersihan
    [
        'name'       => trim((string)$nama),
        'password'   => Hash::make($passwordLms),
        'role'       => 'siswa',
        'class_name' => trim((string)$kelas), // Pastikan class_name ada di $fillable User.php
    ]
);
    }
}