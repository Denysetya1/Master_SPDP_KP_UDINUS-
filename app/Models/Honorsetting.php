<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honorsetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_honor',
        'honor_mhs',
        'pajak',
        'konsumsi',
    ];
}
