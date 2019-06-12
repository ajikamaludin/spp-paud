<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Keuangan;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Exports\LaporanHarianExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Siswa;
use App\Models\Kelas;

class HomeController extends Controller
{
    public function index(){
        $total_uang = Keuangan::where('tipe','in')->sum('jumlah') - Keuangan::where('tipe','out')->sum('jumlah');
        $total_uang_tabungan = Keuangan::where('tipe','in')->where('tabungan_id','!=','null')->sum('jumlah') - Keuangan::where('tipe','out')->where('tabungan_id','!=','null')->sum('jumlah');
        $total_uang_spp = Keuangan::where('tipe','in')->where('transaksi_id','!=','null')->sum('jumlah') - Keuangan::where('tipe','out')->where('transaksi_id','!=','null')->sum('jumlah');;
        $total_uang_masuk = Keuangan::where('tipe','in')->sum('jumlah');
        $total_uang_keluar = Keuangan::where('tipe','out')->sum('jumlah');

        $transaksi = Transaksi::orderBy('siswa_id','desc')->whereDate('created_at', now()->today())->get();

        $siswa = Siswa::count();
        $item = Tagihan::count();
        $kelas = Kelas::count();

        return view('dashboard.index',[
            'total_uang' => $total_uang,
            'total_uang_tabungan' => $total_uang_tabungan,
            'total_uang_spp' => $total_uang_spp,
            'total_uang_masuk' => $total_uang_masuk,
            'total_uang_keluar' => $total_uang_keluar,
            'transaksi' => $transaksi,
            'jumlah' => '0',
            'siswa' => $siswa,
            'item' => $item,
            'kelas' => $kelas,
        ]);
    }

    public function pengaturan(){
        $pengaturan = DB::table('pengaturan')->first();
        if($pengaturan == null){
            DB::table('pengaturan')->insert(['nama' => 'Sistem Informasi']);
            $pengaturan = DB::table('pengaturan')->first();
        }
        return view('pengaturan.index', ['pengaturan' => $pengaturan]);
    }

    public function editpengaturan(){
        $pengaturan = DB::table('pengaturan')->first();
        return view('pengaturan.form', ['pengaturan' => $pengaturan]);
    }

    public function storePengaturan(Request $request){
        $request->validate([
            'nama' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $logo->storeAs('img','logo.jpg','standart');
            $logo = $logo->hashName();
            DB::table('pengaturan')->update(['nama' => $request->nama, 'logo' => $logo]);
        }else{
            DB::table('pengaturan')->update(['nama' => $request->nama]);
        }

        return redirect()->route('pengaturan.index')->with([
            'type' => 'success',
            'msg' => 'Pengaturan diubah'
        ]);
    }

    public function cetak(Request $request){
        $date = \Carbon\Carbon::create($request->date)->format('Y-m-d');
        $transaksi = Transaksi::orderBy('siswa_id','desc')->whereDate('created_at', $date)->get();

        return view('dashboard.export', ['transaksi' => $transaksi, 'date' => $request->date, 'jumlah' => 0, 'print' => true]);
    }

    public function export(Request $request){
        $date = \Carbon\Carbon::create($request->date)->format('Y-m-d');
        return Excel::download(new LaporanHarianExport($date, $request->date), 'laporan-harian-'.now().'.xlsx');
    }
}
