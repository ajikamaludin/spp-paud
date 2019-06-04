<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::orderBy('created_at','desc')->paginate(5);
        return view('periode.index', ['periode' => $periode]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periode.form');
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
            'nama' => 'required|max:255',
            'tgl_mulai' => 'required|date|before:'.$request->tgl_selesai,
            'tgl_selesai' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $periode = Periode::make($request->input());

        if($request->is_active == null){
            $periode->is_active = 0;
        }

        if($periode->save()){
            return redirect()->route('periode.index')->with([
                'type' => 'success',
                'msg' => 'Periode ditambahkan'
            ]);
        }else{
            return redirect()->route('periode.index')->with([
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
    public function edit(Periode $periode)
    {
        return view('periode.form', ['periode' => $periode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periode $periode)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'tgl_mulai' => 'required|date|before:'.$request->tgl_selesai,
            'tgl_selesai' => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $periode->fill($request->input());

        if($request->is_active == null){
            $periode->is_active = 0;
        }

        if($periode->save()){
            return redirect()->route('periode.index')->with([
                'type' => 'success',
                'msg' => 'Periode diubah'
            ]);
        }else{
            return redirect()->route('periode.index')->with([
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
    public function destroy(Periode $periode)
    {
        if($periode->kelas->count() != 0){
            return redirect()->route('periode.index')->with([
                'type' => 'danger',
                'msg' => 'Tidak dapat menghapus periode yang memiliki kelas'
            ]);
        }
        if($periode->delete()){
            return redirect()->route('periode.index')->with([
                'type' => 'success',
                'msg' => 'Periode dihapus'
            ]);
        }else{
            return redirect()->route('periode.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }
}
