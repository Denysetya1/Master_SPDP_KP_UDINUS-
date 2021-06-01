<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaiankp extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_code', 'nip', 'nim', 'mahasiswa',
        'n_1_dosbim',
        'n_2_dosbim',
        'n_3_dosbim',
        'n_tot_dosbim',
        'n_1_penyelia',
        'n_2_penyelia',
        'n_3_penyelia',
        'n_tot_penyelia',
        'n_1_penguji',
        'n_2_penguji',
        'n_3_penguji',
        'n_tot_penguji',
        'n_finish',
    ];

    public function tahunajaran() {
        return $this->belongsTo(Tahunajaran::class, 'tahun_code', 'code');
    }
}
