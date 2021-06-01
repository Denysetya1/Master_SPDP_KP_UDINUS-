<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekaphonor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'dosen',
        'jml_menguji',
        'honor_per_mhs',
        'honor_pajak',
        'honor_konsumsi',
        'honor_tot',
        'rekening_dsn',
    ];

    public function tahunajaran() {
        return $this->belongsTo(Tahunajaran::class, 'tahun_code', 'code');
    }
}
