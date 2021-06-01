<table class=" border">
    <thead>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="7">
            REKAP JADWAL SIDANG KP
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="7">
            SEMESTER {{ $sem }}
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="7">
            PROGRAM STUDI TEKNIK INFORMATIKA - S1
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="7">
            FAKULTAS ILMU KOMPUTER
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="7">
            UNIVERSITAS DIAN NUSWANTORO
        </td>
    </tr>
    <tr></tr>
    <tr>
        <th style="background-color: gray; text-align: center;">Tanggal Sidang</th>
        <th style="background-color: gray; text-align: center;">Waktu</th>
        <th style="background-color: gray; text-align: center;">NPP</th>
        <th style="background-color: gray; text-align: center;">Dosen</th>
        <th style="background-color: gray; text-align: center;">Ruang</th>
        <th style="background-color: gray; text-align: center;">NIM</th>
        <th style="background-color: gray; text-align: center;">Mahasiswa</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rekap as $honors)
        <tr>
            <td>{{ $honors->tgl_start->isoFormat('D MMMM Y') }}</td>
            <td style="text-align: center;">{{ $honors->wkt_start->format('H:i') }} WIB</td>
            <td>{{ $honors->nip }}</td>
            <td>{{ $honors->dosen }}</td>
            <td>{{ $honors->t4_sidang }}</td>
            <td>{{ $honors->nim }}</td>
            <td>{{ $honors->mahasiswa }}</td>
            {{-- <td style="text-align: center;">{{ $honors->created_at->format('d F Y') }}</td> --}}
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
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
        <td></td>
        <td></td>
        <td style="text-align: center;">{{ $koorkp['name'] }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center;">{{ $koorkp['nip'] }}</td>
    </tr>
    </tbody>
</table>
