<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;
    protected $table = 'aplikasi';
    protected $fillable = [
        'nama_aplikasi',
        'jenis_aplikasi',
        'deskripsi',
        'pengaju',
        'alasan_pengajuan',
        'lokasi_penempatan',
        'status',
        'tanggal_pengajuan'
    ];
}
