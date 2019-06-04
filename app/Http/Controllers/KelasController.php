<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Periode;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::orderBy('created_at','desc')->paginate(10);
        return view('kelas.index', ['kelas' => $kelas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = Periode::all();
        return view('kelas.form', ['periode' => $periode]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'periode_id' => 'nullable|numeric',
            'nama' => 'required|max:255',
        ]);

        if(Kelas::create($request->input())){
            return redirect()->route('kelas.index')->with([
                'type' => 'success',
                'msg' => 'Kelas ditambahkan'
            ]);
        }else{
            return redirect()->route('kelas.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        $periode = Periode::all();
        return view('kelas.form', [
            'periode' => $periode,
            'kelas' => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'periode_id' => 'nullable|numeric',
            'nama' => 'required|max:255',
        ]);

        if($kelas->fill($request->input())->save()){
            return redirect()->route('kelas.index')->with([
                'type' => 'success',
                'msg' => 'Kelas diubah'
            ]);
        }else{
            return redirect()->route('kelas.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        if($kelas->siswa->count() != 0){
            return redirect()->route('kelas.index')->with([
                'type' => 'danger',
                'msg' => 'Tidak dapat menghapus kelas yang memiliki siswa'
            ]);
        }
        if($kelas->delete()){
            return redirect()->route('kelas.index')->with([
                'type' => 'success',
                'msg' => 'Kelas dihapus'
            ]);
        }else{
            return redirect()->route('kelas.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }
}
