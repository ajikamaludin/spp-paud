<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use App\Models\Keuangan;
use App\Models\Tabungan;

class TransaksiController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('is_yatim','0')->orderBy('created_at','desc')->get();
        $transaksi = Transaksi::orderBy('created_at','desc')->paginate(10);
        return view('transaksi.index', [
            'siswa' => $siswa,
            'transaksi' => $transaksi,
        ]);
    }

    //pay tagihan
    public function store(Request $request,Siswa $siswa)
    {
        DB::beginTransaction();
        //mulai transaksi, membersihkan request->jumlah dari titik dan koma
        $jumlah = preg_replace("/[,.]/", "", $request->jumlah);
        $jumlah = $jumlah - $request->diskon;

        //membuat transaksi baru
        $transaksi = Transaksi::make([
            'siswa_id' => $siswa->id,
            'tagihan_id' => $request->tagihan_id,
            'diskon' => $request->diskon,
            'is_lunas' => 1,
            'keterangan' => ($request->via == 'tabungan' ? 'dibayarkan melalui tabungan' : 'dibayarkan secara tunai, ').
                            ', '.$request->keterangan,
        ]);
        
        //menyimpan transaksi
        if($transaksi->save()){
            //tambahkan transaksi ke keuangan
            $keuangan = Keuangan::orderBy('created_at','desc')->first();
            if($keuangan != null){
                $total_kas = $keuangan->total_kas + $jumlah;
            }else{
                $total_kas = $jumlah;
            }
            $keuangan = Keuangan::create([
                'transaksi_id' => $transaksi->id,
                'tipe' => 'in',
                'jumlah' => $jumlah,
                'total_kas' => $total_kas,
                'keterangan' => 'Pembayaran SPP oleh '.$transaksi->siswa->nama.' pada tanggal '.$transaksi->created_at.' dengan catatan : dibayarkan dengan '.$request->via.
                                ', '.$request->keterangan
            ]);
        }
        
        // jika pembayaran dilakukan melalui tabungan
        if($request->via == 'tabungan'){
            $tabungan = Tabungan::where('siswa_id', $siswa->id)->orderBy('created_at','desc')->first();
            $menabung = Tabungan::create([
                'siswa_id' => $siswa->id,
                'tipe' => 'out',
                'jumlah' => $jumlah,
                'saldo' => $tabungan->saldo - $jumlah,
                'keperluan' => 'penarikan dilakukan untuk pembayaran spp melalui tabungan',
            ]);

            //tambahkan tabungan ke keuangan
            $keuangan = Keuangan::orderBy('created_at','desc')->first();
            if($keuangan != null){
                $jumlah = $keuangan->total_kas + $menabung->jumlah;
            }else{
                $jumlah = $menabung->jumlah;
            }
            $keuangan = Keuangan::create([
                'tabungan_id' => $menabung->id,
                'tipe' => $menabung->tipe,
                'jumlah' => $menabung->jumlah,
                'total_kas' => $jumlah,
                'keterangan' => 'Transaksi tabungan oleh '. $menabung->siswa->nama."(".$menabung->siswa->kelas->nama.")".
                                        'melakukan pembayaran spp sebesar '. $menabung->jumlah
                                        .' pada '.$menabung->created_at.' dengan total tabungan '.$menabung->saldo
            ]);
        }

        if($keuangan){
            DB::commit();
            return response()->json(['msg' => 'transaksi berhasil dilakukan']);
        }else{
            DB::rollBack();
            return redirect()->route('spp.index')->with([
                'type' => 'danger',
                'msg' => 'terjadi kesalahan'
            ]);
        }
        
    }

    //get list tagihan of siswa
    public function tagihan(Siswa $siswa)
    {
        //wajib semua
        $tagihan_wajib = Tagihan::where('wajib_semua','1')->get()->toArray();

        //kelas only
        $tagihan_kelas = Tagihan::where('kelas_id', $siswa->kelas->id)->get()->toArray();

        //student only
        $tagihan_siswa = [];
        $tagihan_rolesiswa = $siswa->role;
        foreach($tagihan_rolesiswa as $tag_siswa){
            $tagihan_siswa[] = $tag_siswa->tagihan->toArray();
        }

        $tagihan = array_merge($tagihan_wajib, $tagihan_kelas, $tagihan_siswa);

        return response()->json($tagihan);
    }
}
