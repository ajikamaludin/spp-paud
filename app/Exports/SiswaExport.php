<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::with('kelas')->get();
    }

    public function view(): View
    {
        return view('siswa.export', [
            'siswa' => $this->collection()
        ]);
    }
}
