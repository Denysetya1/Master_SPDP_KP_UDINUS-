<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilaikpset extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis', 'prosentase1', 'prosentase2', 'prosentase3', 'status'
    ];
}
