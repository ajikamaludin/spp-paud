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
    @foreach($keuangan as $item)
        <tr>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>{{ ($item->tipe == 'in') ? 'Pemasukan' : 'Pengeluaran' }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->keterangan }}</td>
        </tr>
    @endforeach
    </tbody>
</table>