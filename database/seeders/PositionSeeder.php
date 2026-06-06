<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('positions')->insert([
            ['nama_jabatan' => 'Admin'],
            ['nama_jabatan' => 'Guru'],
            ['nama_jabatan' => 'Siswa'],
        ]);
    }
}