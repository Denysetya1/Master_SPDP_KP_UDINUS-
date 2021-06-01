<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahunajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'tahun1', 'tahun2', 'semester', 'status',
    ];
}
