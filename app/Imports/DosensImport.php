<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosensImport implements ToModel, WithHeadingRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dosen([
            'nip'           => $row['npp'],
            'name'          => $row['pembimbing'],
            'jabfa'         => '-',
            'level'         => '-',
            'ta'            => '0',
            'kp'            => '0'
        ]);
    }
    public function onError(\Throwable $e)
    {
    }
}
