<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuotakptotal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_code', 'total', 'jml_ajuan'
    ];

    public function tahunajaran() {
        return $this->belongsTo(Tahunajaran::class, 'tahun_code', 'code');
    }
}
