<table>
    <thead>
    <tr>
        <th><b>Tanggal</b></th>
        <th><b>Siswa</b></th>
        <th><b>Tagihan</b></th>
        <th><b>Diskon</b></th>
        <th><b>Dibayarkan</b></th>
        <th><b>Keterangan</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($transaksi as $item)
        <tr>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>{{ $item->siswa->nama.'('.$item->siswa->kelas->nama.')' }}</td>
            <td>{{ $item->tagihan->nama }}</td>
            <td>IDR. {{ format_idr($item->diskon) }}</td>
            <td>IDR. {{ format_idr($item->keuangan->jumlah) }}</td>
            <td style="max-width:150px;">{{ $item->keterangan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>