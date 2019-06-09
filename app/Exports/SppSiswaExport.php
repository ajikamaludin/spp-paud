<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SppSiswaExport implements FromView
{
    public function __construct($siswa, $transaksi, $tanggal)
    {
        $this->siswa = $siswa;
        $this->transaksi = $transaksi;
        $this->tanggal = $tanggal;
    }
    
    public function view(): View
    {
        return view('transaksi.export', [
            'siswa' => $this->siswa,
            'transaksi' => $this->transaksi,
            'tanggal' => $this->tanggal
        ]);
    }
}
