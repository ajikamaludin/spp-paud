<table>
    <thead>
    <tr>
        <th><b>Tanggal</b></th>
        <th><b>Siswa</b></th>
        <th><b>KD</b></th>
        <th><b>Jumlah</b></th>
        <th><b>Keterangan</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($tabungan as $item)
        <tr>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>{{ $item->siswa->nama."(".$item->siswa->kelas->nama.")" }}</td>
            <td>{{ ($item->tipe == 'in') ? 'Menabung' : 'Penarikan Uang' }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->keperluan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>