<table class=" border">
    <thead>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="2">
            Rekap EWMP Daftar Jumlah Mahasiswa Bimbingan
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="2">
            Kerja Praktek Teknik Informatika TI / S1
        </td>
    </tr>
    <tr>
        <td style=" font-weight: bold; text-align: center;" colspan="2">
            Semester {{ $sem }}
        </td>
    </tr>
    <tr></tr>
    <tr>
        <th style="background-color: gray; text-align: center;">Pembimbing Kerja Praktek</th>
        <th style="background-color: gray; text-align: center;">Jumlah Mahasiswa</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rekap as $honors)
        <tr>
            <td>{{ $honors->nip }}  - {{ $honors->name }}</td>
            <td>{{ $honors->jml_terima }}</td>
        </tr>
    @endforeach
    <tr>
        <td style=" font-weight: bold; text-align: center;">TOTAL</td>
        <td>{{ $rekap->sum('jml_terima') }}</td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td style="text-align: center;">Semarang, {{ $tgl->isoFormat('D MMMM Y') }}</td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: center;">Mengetahui Koordinator KP TI S1</td>
    </tr>
    <tr style="text-align: center;"></tr>
    <tr style="text-align: center;"></tr>
    <tr style="text-align: center;"></tr>
    <tr style="text-align: center;"></tr>
    <tr>
        <td></td>
        <td style="text-align: center;">{{ $koorkp['name'] }}</td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: center;">{{ $koorkp['nip'] }}</td>
    </tr>
    </tbody>
</table>
