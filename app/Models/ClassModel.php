<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    // Nama tabel di database kamu
    protected $table = 'classes'; 

    // Kolom yang boleh diisi
    protected $fillable = ['nama_class']; 
}
