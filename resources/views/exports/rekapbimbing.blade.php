<table class=" border">
    <thead>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="5">
            REKAP DOSEN PEMBIMBING DAN MAHASISWA
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="5">
            SEMESTER {{ $sem }}
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="5">
            PROGRAM STUDI TEKNIK INFORMATIKA - S1
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="5">
            FAKULTAS ILMU KOMPUTER
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="5">
            UNIVERSITAS DIAN NUSWANTORO
        </td>
    </tr>
    <tr></tr>
    <tr>
        <th style="background-color: gray; text-align: center;">NPP</th>
        <th style="background-color: gray; text-align: center;">DOSEN PEMBIMBING</th>
        <th style="background-color: gray; text-align: center;">NIM</th>
        <th style="background-color: gray; text-align: center;">MAHASISWA</th>
        <th style="background-color: gray; text-align: center;">WAKTU PERSETUJUAN</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rekap as $honors)
        <tr>
            <td>{{ $honors->nip }}</td>
            <td>{{ $honors->dosen }}</td>
            <td>{{ $honors->nim }}</td>
            <td>{{ $honors->mahasiswa }}</td>
            <td style="text-align: center;">{{ $honors->created_at->format('d F Y') }}</td>
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center;">Semarang, {{ $tgl->isoFormat('D MMMM Y') }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center;">Mengetahui Koordinator KP TI S1</td>
    </tr>
    <tr style="text-align: center;"></tr>
    <tr style="text-align: center;"></tr>
    <tr style="text-align: center;"></tr>
    <tr style="text-align: center;"></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center;">{{ $koorkp['name'] }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center;">{{ $koorkp['nip'] }}</td>
    </tr>
    </tbody>
</table>
