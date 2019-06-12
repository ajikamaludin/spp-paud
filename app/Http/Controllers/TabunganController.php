<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabungan;
use App\Models\Siswa;
use App\Models\Keuangan;
use Illuminate\Support\Facades\DB;
use App\Exports\TabunganExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TabunganSiswaExport;

class TabunganController extends Controller
{
    public function index()
    {
        $siswa = Siswa::orderBy('created_at','desc')->get();
        $tabungan = Tabungan::orderBy('created_at','desc')->paginate(10);
        return view('tabungan.index', [
            'siswa' => $siswa,
            'tabungan' => $tabungan,
        ]);
    }

    public function transaksiCetak($id)
    {
        $tabungan = Tabungan::find($id);
        $siswa = $tabungan->siswa;
        $input = Tabungan::where('tipe','in')->where('siswa_id',$siswa->id)->sum('jumlah');
        $output = Tabungan::where('tipe','out')->where('siswa_id',$siswa->id)->sum('jumlah');

        $verify = Tabungan::where('siswa_id', $siswa->id)->orderBy('created_at','desc')->first()->saldo;
        return view('tabungan.tabunganprint', [
            'siswa' => $siswa,
            'tabungan' => $tabungan,
            'saldo' => format_idr($input - $output).(($input - $output) == $verify ? '' : ' invalid'),
        ]);
    }

    //api manabung
    public function menabung(Request $request, Siswa $siswa)
    {
        $jumlah_bersih = preg_replace("/[,.]/", "", $request->jumlah);
        DB::beginTransaction();
        $tabungan = Tabungan::where('siswa_id', $siswa->id)->orderBy('created_at','desc')->first();
        if($tabungan != null){
            $menabung = Tabungan::make($request->except('jumlah'));
            $menabung->jumlah = $jumlah_bersih;
            if($request->tipe == 'in'){
                $menabung->saldo = $jumlah_bersih + $tabungan->saldo;
            }else if($request->tipe == 'out'){
                $menabung->saldo = $tabungan->saldo - $jumlah_bersih;
            }
            if($menabung->saldo >=0 ){
                $menabung->save();
                $pesan = 'Berhasil melakukan transaksi';
            }else{
                $pesan = 'Transaksi gagal';
            }
        }else{
            $menabung = Tabungan::make($request->except('jumlah'));
            $menabung->jumlah = $jumlah_bersih;
            $menabung->saldo = $jumlah_bersih;
            $menabung->save();
            $pesan = 'Berhasil melakukan transaksi';
        }

        //tambahkan tabungan ke keuangan
        $keuangan = Keuangan::orderBy('created_at','desc')->first();
        if($keuangan != null){
            if($menabung->tipe == 'in'){
                $jumlah = $keuangan->total_kas + $menabung->jumlah;
            }else if($request->tipe == 'out'){
                $jumlah = $keuangan->total_kas - $menabung->jumlah;
            }
        }else{
            $jumlah = $menabung->jumlah;
        }
        $keuangan = Keuangan::create([
            'tabungan_id' => $menabung->id,
            'tipe' => $menabung->tipe,
            'jumlah' => $menabung->jumlah,
            'total_kas' => $jumlah,
            'keterangan' => 'Transaksi tabungan oleh '. $menabung->siswa->nama."(".$menabung->siswa->kelas->nama.")".
                                    ( ($request->tipe == 'in') ? ' menabung' : ' melakukan penarikan tabungan').' sebesar '. $menabung->jumlah
                                    .' pada '.$menabung->created_at.' dengan total tabungan '.$menabung->saldo.
                                    ( (isset($menabung->keperluan)) ?  ' dengan catatan: '.$menabung->keperluan : ''),
        ]);

        if($keuangan){
            DB::commit();
            return response()->json(['msg' => $pesan]);
        }else{
            DB::rollBack();
            return redirect()->route('tabungan.index')->with([
                'type' => 'danger',
                'msg' => 'terjadi kesalahan'
            ]);
        }
        
    }

    public function export()
    {
        return Excel::download(new TabunganExport, 'mutasi_tabungan-'.now().'.xlsx');
    }

    public function cetak(Siswa $siswa)
    {
        $input = Tabungan::where('tipe','in')->where('siswa_id',$siswa->id)->sum('jumlah');
        $output = Tabungan::where('tipe','out')->where('siswa_id',$siswa->id)->sum('jumlah');

        $verify = Tabungan::where('siswa_id', $siswa->id)->orderBy('created_at','desc')->first()->saldo;
        $tabungan = Tabungan::where('siswa_id', $siswa->id)->orderBy('created_at','desc')->get();
        return view('tabungan.print', [
            'siswa' => $siswa,
            'tabungan' => $tabungan,
            'saldo' => format_idr($input - $output).(($input - $output) == $verify ? '' : ' invalid'),
        ]);
    }

    public function siswaexport(Siswa $siswa)
    {
        return Excel::download(new TabunganSiswaExport($siswa), 'tabungan_siswa-'.now().'.xlsx');
    }
}
