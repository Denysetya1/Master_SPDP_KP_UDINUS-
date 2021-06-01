<table>
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>NPP</th>
        <th>Nama Dosen</th>
        <th>Ruang</th>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
    </tr>
    </thead>
    <tbody>
    @foreach($jadwals as $jadwal)
        <tr>
            <td>{{ Date::dateTimeToExcel($jadwal->tgl_start) }}</td>
            <td>{{ Date::dateTimeToExcel($jadwal->wkt_start) }}</td>
            <td>{{ $jadwal->nip }}</td>
            <td>{{ $jadwal->dosen }}</td>
            <td>{{ $jadwal->t4_sidang }}</td>
            <td>{{ $jadwal->nim }}</td>
            <td>{{ $jadwal->mahasiswa }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
