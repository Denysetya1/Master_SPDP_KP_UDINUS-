<?php

namespace App\Exports;

use App\Models\Kpdosbim;
use App\Models\Pejabat;
use App\Models\Tahunajaran;
use DateTime;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class EwmpExport implements FromView,
ShouldAutoSize,
WithDrawings,
// WithColumnFormatting,
WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data    = Tahunajaran::where('status', 1)->first();
        $sem     = $data['semester'].' '.$data['tahun1'].'/'.$data['tahun2'];
        $koorkp  = Pejabat::where('jabatan', '=', 'Koor Kp')->first();
        // $dsn     = DB::table('recordkps')->select('nip')->groupBy('nip')->havingRaw('COUNT(nip) >= ?', [1])->get()->toArray();
        return view('exports.rekapewmp', [
            'sem'       => $sem,
            'koorkp'    => $koorkp,
            'rekap'     => Kpdosbim::where('status', 1)->orderBy('nip', 'asc')->get(),
            'tgl'       => now(),
        ]);
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'A' => NumberFormat::FORMAT_DATE_XLSX15,
    //         'B' => NumberFormat::FORMAT_DATE_TIME1,
    //     ];
    // }

    public function styles(Worksheet $sheet)
    {
        $jml     = Kpdosbim::where('status', 1)->count() + 6;
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
            5   =>  [
                        'font'  => ['bold' => true, 'size' => 14],
                        'color' => ['#FF000000'],
                        'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER],
                    ],
            $jml=>  [
                        'font'  => ['bold' => true, 'size' => 14],
                        'color' => ['#FF000000'],
                        'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER],
                    ],
        ];
    }

    public function drawings()
    {
        $jml     = Kpdosbim::where('status', 1)->count() + 11;
        $kord    = 'B'.$jml;
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/TTD.png'));
        $drawing->setHeight(75);
        $drawing->setCoordinates($kord);

        return $drawing;
    }
}
