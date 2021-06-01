<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tadosbim extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip', 'name', 'kuota', 'jml_terima', 'status'
    ];

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'nip', 'nip');
    }

    // public function tapengajuan() {
    //     return $this->hasMany(Tapengajuan::class, 'nip', 'nip');
    // }

    // public function jmlajuan($nip, $status) {
    //     return Tapengajuan::where('nip', $nip)->where('status', $status)->count();
    // }
}
