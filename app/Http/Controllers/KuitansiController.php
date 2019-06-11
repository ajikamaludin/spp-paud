<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuitansi;

class KuitansiController extends Controller
{
    public function index()
    {
        $kuitansi = Kuitansi::orderBy('created_at','desc')->paginate(10);
        return view('kuitansi.index', ['kuitansi' => $kuitansi]);
    }

    public function store(Request $request)
    {
        $semua = [];
        $data = $request->data;
        $lastnum = 1;
        foreach($data as $dat){
            if(!isset($semua[$dat['num']])){
                $semua[$dat['num']] = ['nama' => $dat['value']];
            }
            if($dat['num'] == $lastnum){//1, 1,
                $semua[$dat['num']] = array_add($semua[$dat['num']], $dat['key'], $dat['value']); 
            }
            $lastnum = $dat['num'];
        }
        foreach($semua as $index => $sem){
            if(count($sem) <= 2){
                unset($semua[$index]);
            }
        }

        if($request->total != 0){
            $kuitansi = Kuitansi::create([
                'invoice' => $request->invoice,
                'items' => json_encode($semua),
                'total' => $request->total
            ]);
            if($kuitansi){
                $pesan = 'success';
            }else{
                $pesan = 'fail';
            }
        }else{
            $pesan = 'fail';
        }


        
        return response()->json(['msg' => $pesan]);
    }

    public function print(Kuitansi $kuitansi)
    {
        $items = json_decode($kuitansi->items);
        return view('kuitansi.print', ['kuitansi' => $kuitansi,'items' => $items]);
    }
}
