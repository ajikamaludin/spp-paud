<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SppExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::orderBy('created_at','desc')->get();
    }

    public function view(): View
    {
        return view('transaksi.transaksiexport', [
            'transaksi' => $this->collection(),
        ]);
    }
}
