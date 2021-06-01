<?php

namespace App\Exports;

use App\Models\Jadwalsidang;
use App\Models\Pejabat;
use App\Models\Tahunajaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class JadwalsExport implements FromView,
ShouldAutoSize,
WithColumnFormatting,
WithStyles,
WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data    = Tahunajaran::where('status', 1)->first();
        $sem     = $data['semester'].' '.$data['tahun1'].'/'.$data['tahun2'];
        $koorkp  = Pejabat::where('jabatan', '=', 'Koor Kp')->first();
        return view('exports.rekapjadwal', [
            'sem'       => $sem,
            'koorkp'    => $koorkp,
            'rekap'     => Jadwalsidang::orderBy('tgl_start', 'asc')->orderBy('wkt_start', 'asc')->orderBy('t4_sidang', 'asc')->get(),
            'tgl'       => now(),
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_XLSX15,
            // 'B' => NumberFormat::FORMAT_DATE_TIME1,
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
        $jml     = Jadwalsidang::count() + 12;
        $kord    = 'G'.$jml;
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/TTD.png'));
        $drawing->setHeight(75);
        $drawing->setCoordinates($kord);

        return $drawing;
    }
}
