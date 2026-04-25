<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    // Nama tabel di database kamu
    protected $table = 'positions';

    // Kolom yang boleh diisi
    protected $fillable = ['nama_jabatan'];
}