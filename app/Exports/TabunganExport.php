<?php

namespace App\Exports;

use App\Models\Tabungan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TabunganExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tabungan::all();
    }

    public function view(): View
    {
        return view('tabungan.export', [
            'tabungan' => $this->collection()
        ]);
    }
}
