<table>
        <thead>
        <tr>
            <th><b>Kelas</b></th>
            <th><b>Nama</b></th>
            <th><b>Tempat Lahir</b></th>
            <th><b>Tanggal Lahir</b></th>
            <th><b>Jenis Kelamin</b></th>
            <th><b>Alamat</b></th>
            <th><b>Nama Wali</b></th>
            <th><b>No.Telp. Wali</b></th>
            <th><b>Pekerjaan Wali</b></th>
            <th><b>Keterangan</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($siswa as $item)
            <tr>
                <td>{{ $item->kelas->nama }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->tempat_lahir }}</td>
                <td>{{ $item->tanggal_lahir }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->nama_wali }}</td>
                <td>{{ $item->telp_wali }}</td>
                <td>{{ $item->pekerjaan_wali }}</td>
                <td>{{ ($item->is_yatim) ? 'Yatim' : '' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>