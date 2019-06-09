<h2 style="text-align:center"><b> {{ $sitename }} </b></h2>
    <h3 style="text-align:center">Tanda Bukti Pembayaran</h3>
    <br>
    <p><b>Nama :</b> {{ $siswa->nama }}   <b>Kelas : </b>  {{ $siswa->kelas->nama }}{{ isset($siswa->kelas->periode) ? '('.$siswa->kelas->periode->nama.')' : '' }}</p>
    <p><b>Tanggal : </b> {{ $tanggal }}</p>
    <table style="border: 1px solid black; width: 100%">
        <tr style="border: 1px solid black;">
            <th>No</th>
            <th>Tagihan</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
        @foreach ($transaksi as $index => $item)
        <tr class="{{ ($index%2) ? 'gray' : '' }}">
            <td style="min-width:20px;text-align: center;">
                {{ $index+1 }}
            </td>
            <td style="min-width:200px;text-align: center;">
                {{ $item->tagihan->nama }}
            </td>
            <td style="min-width:80px;text-align: center;">
                {{ $item->created_at->format('d-m-Y') }}
            </td>
            <td style="min-width:200px;text-align: left;">
                IDR. {{ format_idr($item->keuangan->jumlah) }}
            </td>
            <td style="min-width:20px;text-align: center;">
                {{ $item->keterangan }}
            </td>
        </tr>
        @endforeach
    </table>