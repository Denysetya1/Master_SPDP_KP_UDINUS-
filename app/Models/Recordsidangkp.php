<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordsidangkp extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_code', 'nim', 'nip', 'mahasiswa', 'dosen', 'batch'
    ];

    public function tahunajaran() {
        return $this->belongsTo(Tahunajaran::class, 'tahun_code', 'code');
    }

    // public function mhskp() {
    //     return $this->belongsTo(Mhskp::class, 'nim', 'nim');
    // }
}
