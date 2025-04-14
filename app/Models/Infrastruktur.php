<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastruktur extends Model
{
    use HasFactory;
    protected $table = 'infrastrukturs';
    protected $fillable = [
        'name',
        'type',
        'ip_address',
        'location',
        'status'
    ];
}
