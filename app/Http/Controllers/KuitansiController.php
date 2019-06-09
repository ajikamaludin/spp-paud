<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KuitansiController extends Controller
{
    public function index()
    {
        return view('kuitansi.index');
    }
}
