<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanHarianExport implements FromView
{

    public function __construct($date, $tanggal)
    {
        $this->date = $date;
        $this->tanggal = $tanggal;
    }
    public function collection()
    {
        return Transaksi::orderBy('siswa_id','desc')->whereDate('created_at', $this->date)->get();
    }

    public function view(): View
    {
        return view('dashboard.export', [
            'transaksi' => $this->collection(),
            'date' => $this->date,
            'tanggal' => $this->tanggal,
            'jumlah' => 0
        ]);
    }
}
