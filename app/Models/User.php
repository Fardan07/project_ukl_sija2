<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Report; // <-- TAMBAHKAN INI
use App\Models\ClassModel;
use App\Models\Position;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'no_guru',
    'position_id',
    'class_id',
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // TAMBAHKAN METHOD INI DI BAWAH
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    

// Relasi ke Tabel Class
public function class()
{
    // Pastikan nama modelnya ClassModel (sesuai yang kamu buat)
    return $this->belongsTo(ClassModel::class, 'class_id');
}

// Relasi ke Tabel Position
public function position()
{
    return $this->belongsTo(Position::class, 'position_id');
}



}