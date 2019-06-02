<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi';

    protected $fillable = [
        'siswa_id',
        'tagihan_id',
        'total',
        'diskon',
        'is_lunas',
        'keterangan'
    ];

    public function tagihan(){
        return $this->hasOne('App\Models\Tagihan','id','tagihan_id');
    }

    public function siswa(){
        return $this->hasOne('App\Models\Siswa','id','siswa_id');
    }

    public function keuangan(){
        return $this->hasOne('App\Models\Keuangan','transaksi_id','id');
    }
}
