<p><b>Nama :</b> {{ $siswa->nama }}   <b>Kelas : </b>  {{ $siswa->kelas->nama }}{{ isset($siswa->kelas->periode) ? '('.$siswa->kelas->periode->nama.')' : '' }}</p>
<table>
    <thead>
    <tr>
        <th><b>Tanggal</b></th>
        <th><b>KD</b></th>
        <th><b>Jumlah</b></th>
        <th><b>Keterangan</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($tabungan as $item)
        <tr>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>{{ ($item->tipe == 'in') ? 'Menabung' : 'Penarikan Uang' }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->keperluan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>