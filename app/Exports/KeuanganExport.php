<?php

namespace App\Exports;

use App\Models\Keuangan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KeuanganExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Keuangan::all();
    }

    public function view(): View
    {
        return view('keuangan.export', [
            'keuangan' => $this->collection()
        ]);
    }
}
