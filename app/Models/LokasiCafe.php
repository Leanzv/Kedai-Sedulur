<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiCafe extends Model
{
    use HasFactory;

    protected $table = 'lokasi_cafe';

    protected $fillable = [
        'nama_cafe',
        'alamat',
        'latitude',
        'longitude',
        'deskripsi',
    ];
}