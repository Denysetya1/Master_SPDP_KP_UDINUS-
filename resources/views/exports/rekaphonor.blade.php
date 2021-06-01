<table class=" border">
    <thead>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="8">
            REKAP HONOR MENGUJI KERJA PRAKTEK
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="8">
            SEMESTER {{ $sem }}
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="8">
            PROGRAM STUDI TEKNIK INFORMATIKA - S1
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="8">
            FAKULTAS ILMU KOMPUTER
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="8">
            UNIVERSITAS DIAN NUSWANTORO
        </td>
    </tr>
    <tr></tr>
    <tr>
        <th rowspan="2" style="background-color: gray; text-align: center;">Penguji</th>
        <th rowspan="2" style="background-color: gray; text-align: center;">Jumlah Menguji</th>
        <th style="background-color: gray; text-align: center;">Honor</th>
        <th style="background-color: gray; text-align: center;">Pajak</th>
        <th style="background-color: gray; text-align: center;">Konsumsi</th>
        <th rowspan="2" style="background-color: gray; text-align: center;">Terima</th>
        <th rowspan="2" style="background-color: gray; text-align: center;">Rekening</th>
    </tr>
    <tr>
        <th style=" font-weight: bold; background-color: gray;" >{{ $honor->honor_mhs }}</th>
        <th style=" font-weight: bold; background-color: gray; text-align: center;" >{{ $honor->pajak }} %</th>
        <th style=" font-weight: bold; background-color: gray;" >{{ $honor->konsumsi }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rekap as $honors)
        <tr>
            <td>{{ $honors->dosen }}</td>
            <td style="text-align: center;">{{ $honors->jml_menguji }}</td>
            <td>{{ $honors->honor_per_mhs }}</td>
            <td>{{ $honors->honor_pajak }}</td>
            <td>{{ $honors->honor_konsumsi }}</td>
            <td>{{ $honors->honor_tot }}</td>
            <td>{{ $honors->rekening_dsn }}</td>
        </tr>
    @endforeach
        <tr>
            <td style=" font-weight: bold; text-align: center;">TOTAL</td>
            <td style=" font-weight: bold; text-align: center;">{{ $totUji }}</td>
            <td style=" font-weight: bold; text-align: center;">{{ $totHonor }}</td>
            <td style=" font-weight: bold; text-align: center;">{{ $totPajak }}</td>
            <td style=" font-weight: bold; text-align: center;">{{ $totKon }}</td>
            <td style=" font-weight: bold; text-align: center;">{{ $totTerima }}</td>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" style="text-align: center;">Semarang,  {{ $tgl->isoFormat('D MMMM Y') }}</td>
            <td></td>
        </tr>
        <tr>
            <td style="text-align: center;">Ka. Prodi Teknik Informatika - S1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" style="text-align: center;">Koordinator KP FIK</td>
            <td></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td style="text-align: center;">{{ $kapro['name'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" style="text-align: center;">{{ $koorkp['name'] }}</td>
            <td></td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $kapro['nip'] }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" style="text-align: center;">{{ $koorkp['nip'] }}</td>
            <td></td>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2" style="text-align: center;">Mengetahui,</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2" style="text-align: center;">Dekan Fakultas Ilmu Komputer</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2" style="text-align: center;">{{ $dekan['name'] }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2" style="text-align: center;">{{ $dekan['nip'] }}</td>
        </tr>
    </tbody>
</table>
