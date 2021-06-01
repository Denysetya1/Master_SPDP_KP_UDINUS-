<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpdosbim extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip', 'name', 'kuota', 'jml_terima', 'jml_terima', 'sisa', 'status'
    ];

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'nip', 'nip');
    }

    public function kppengajuan() {
        return $this->hasMany(Kppengajuan::class, 'nip', 'nip');
    }
}
