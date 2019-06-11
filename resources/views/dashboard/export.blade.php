<h2 style="text-align:center"><b> {{ $sitename }} </b></h2 >
    <h3 style="text-align:center">Laporan Harian</h3>
    <p><b>Tanggal :</b> {{ $date }} </p>
<table style="border: 1px solid black; width: 100%">
    <thead style="border: 1px solid black;">
    <tr>
        <th><b>Tanggal</b></th>
        <th><b>Nama</b></th>
        <th><b>Pembayaran</b></th>
        <th><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($transaksi as $index => $item)
        <tr class="{{ ($index%2) ? 'gray' : '' }}">
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>{{ $item->siswa->nama." (".$item->siswa->kelas->nama.")" }}</td>
            <td>{{ $item->tagihan->nama }}</td>
            <td>IDR. {{ format_idr($item->keuangan->jumlah) }}</td>
            @php
                $jumlah += $item->keuangan->jumlah
            @endphp
        </tr>
    @endforeach
        <tr>
            <td><b>Total</b></td>
            <td></td>
            <td></td>
            <td>IDR. {{ format_idr($jumlah) }}</td>
        </tr>
    </tbody>
</table>
@if(isset($print))
<style>
@media print {
    tr.gray {
        background-color: #ececec !important;
        -webkit-print-color-adjust: exact; 
    }
    th {
        background-color: #dadada !important;
        -webkit-print-color-adjust: exact; 
    }
}
</style>
<script>
    window.print()
    window.onafterprint = function(){
        window.close()
    }
</script>
@endif