<?php

namespace App\Exports;

use App\Models\Pejabat;
use App\Models\Recordkp as ModelsRecordkp;
use App\Models\Tahunajaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class KpmhsExport implements FromView,
ShouldAutoSize,
WithColumnFormatting,
WithDrawings,
WithStyles
{
    public function view(): View
    {
        $data    = Tahunajaran::where('status', 1)->first();
        $sem     = $data['semester'].' '.$data['tahun1'].'/'.$data['tahun2'];
        $koorkp  = Pejabat::where('jabatan', '=', 'Koor Kp')->first();
        return view('exports.rekapbimbing', [
            'sem'       => $sem,
            'rekap'     => ModelsRecordkp::orderBy('nip', 'asc')->orderBy('mahasiswa', 'asc')->get(),
            'koorkp'    => $koorkp,
            'tgl'       => now(),
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1   =>  [
                        'font'  => ['bold' => true, 'size' => 13],
                    ],
            2   =>  [
                        'font'  => ['bold' => true, 'size' => 13],
                    ],
            3   =>  [
                        'font'  => ['bold' => true, 'size' => 13],
                    ],
            4   =>  [
                        'font'  => ['bold' => true, 'size' => 13],
                    ],
            5   =>  [
                        'font'  => ['bold' => true, 'size' => 13],
                    ],
            7   =>  [
                        'font'  => ['bold' => true, 'size' => 14],
                        'color' => ['#FF000000'],
                        'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER],
                    ],
        ];
    }

    public function drawings()
    {
        $jml     = ModelsRecordkp::count() + 12;
        $kord    = 'E'.$jml;
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/TTD.png'));
        $drawing->setHeight(75);
        $drawing->setCoordinates($kord);

        return $drawing;
    }

}
