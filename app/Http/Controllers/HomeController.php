<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        return view('dashboard.index');
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
}
