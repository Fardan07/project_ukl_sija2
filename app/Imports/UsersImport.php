<?php

namespace App\Imports;

use App\Models\User;
use App\Models\ClassModel; // 1. WAJIB TAMBAH INI AGAR MODEL KELAS BISA DIBACA
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

        // Mapping data
        $nama        = $cleanRow['nama'] ?? $cleanRow['nama_siswa'] ?? null;
        $usernameLms = $cleanRow['username_mylms'] ?? $cleanRow['username_my_lms'] ?? null;
        $passwordLms = $cleanRow['password_mylms'] ?? $cleanRow['password_my_lms'] ?? 'Skomda123@';
        $kelas       = $cleanRow['kelas'] ?? $cleanRow['kelas_baru'] ?? null;

        // BERSIHKAN FORMAT .0 DARI EXCEL
        $usernameClean = str_replace('.0', '', (string)$usernameLms);

        if (empty($nama) || empty($usernameLms)) {
            return null;
        }

        // 2. CARI ATAU BUAT KELAS OTOMATIS DI DATABASE DI SINI
        $classId = null;
        if ($kelas) {
            $kelasData = ClassModel::firstOrCreate(
                ['nama_class' => trim($kelas)]
            );
            $classId = $kelasData->id; // Ambil ID asli dari database tabel classes
        }

        return User::updateOrCreate(
            ['email' => trim($usernameClean)],
            [
                'name'       => trim((string)$nama),
                'password'   => Hash::make($passwordLms),
                'role'       => 'siswa',
                'class_name' => trim((string)$kelas), 
                'class_id'   => $classId, // 3. SEKARANG MENGGUNAKAN $classId HASIL LOOKUP DATABASE
            ]
        );
    }
}