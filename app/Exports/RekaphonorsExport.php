<?php

namespace App\Exports;

use App\Models\Honorsetting;
use App\Models\Pejabat;
use App\Models\Rekaphonor as ModelsRekaphonor;
use App\Models\Tahunajaran;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekaphonorsExport implements FromView,
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
        $dekan   = Pejabat::where('jabatan', '=', 'Dekan')->first();
        $kapro   = Pejabat::where('jabatan', '=', 'Ka Prodi')->first();
        $koorkp  = Pejabat::where('jabatan', '=', 'Koor Kp')->first();
        return view('exports.rekaphonor', [
            'dekan'     => $dekan,
            'kapro'     => $kapro,
            'koorkp'    => $koorkp,
            'sem'       => $sem,
            'rekap'     => ModelsRekaphonor::orderBy('dosen', 'asc')->get(),
            'totUji'    => ModelsRekaphonor::sum('jml_menguji'),
            'totHonor'  => ModelsRekaphonor::sum('honor_per_mhs'),
            'totPajak'  => ModelsRekaphonor::sum('honor_pajak'),
            'totKon'    => ModelsRekaphonor::sum('honor_konsumsi'),
            'totTerima' => ModelsRekaphonor::sum('honor_tot'),
            'honor'     => Honorsetting::where('code_honor', '=', 'Hnr-00-01')->first(),
            'tgl'       => now(),
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_CURRENCY_ID,
            'D' => NumberFormat::FORMAT_CURRENCY_ID,
            'E' => NumberFormat::FORMAT_CURRENCY_ID,
            'F' => NumberFormat::FORMAT_CURRENCY_ID,
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
        $jml     = ModelsRekaphonor::count() + 13;
        $kord    = 'F'.$jml;
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/TTD.png'));
        $drawing->setHeight(75);
        $drawing->setCoordinates($kord);

        return $drawing;
    }
}
