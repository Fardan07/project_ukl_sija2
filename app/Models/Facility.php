<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['nama_fasilitas', 'kategori'];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}