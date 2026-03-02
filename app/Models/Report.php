<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'facility_id',
        'location_id',
        'deskripsi',
        'foto',
        'status',
        'catatan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}