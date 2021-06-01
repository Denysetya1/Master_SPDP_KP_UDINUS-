<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip', 'name', 'jabfa', 'level', 'ta', 'kp', 'photo'
    ];

    public function kpdosbim() {
        return $this->hasOne(Kpdosbim::class, 'nip', 'nip');
    }

    public function tadosbim() {
        return $this->hasOne(Tadosbim::class, 'nip', 'nip');
    }

    // public function koorkp() {
    //     return $this->hasOne(Koorkp::class);
    // }

    // public function koorta() {
    //     return $this->hasOne(Koortah::class);
    // }

    // public function kpdsn() {
    //     return $this->hasOne(Kpdsn::class, 'nip', 'nip');
    // }

    // public function kppengajuan() {
    //     return $this->hasMany(Kppengajuan::class, 'nip', 'nip');
    // }

}
