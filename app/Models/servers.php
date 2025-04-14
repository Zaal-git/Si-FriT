<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
    use HasFactory;

    protected $table = 'servers'; // Nama tabel di database

    protected $fillable = [
        'name',
        'ip_address',
        'location',
        'status'
    ];
}
