<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Tabungan;
use App\Models\Siswa;

class TabunganSiswaExport implements FromView
{
    public function __construct($siswa)
    {
        $this->id = $siswa->id;
        $this->siswa = $siswa;
    }
    public function collection()
    {
        return Tabungan::where('siswa_id', $this->id)->get();
    }

    public function view(): View
    {
        return view('siswa.tabunganexport', [
            'tabungan' => $this->collection(),
            'siswa' => $this->siswa
        ]);
    }
}
