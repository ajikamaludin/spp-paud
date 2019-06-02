<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use SoftDeletes;

    protected $table = 'tagihan';

    protected $fillable = [
        'nama',
        'jumlah',
        'wajib_semua',
        'hanya_kelas'
    ];

    public function transaksi(){
        return $this->hasMany('App\Models\Transaksi','tagihan_id','id');
    }

    public function role(){
        return $this->hasMany('App\Models\Role','tagihan_id','id');
    }

    public function siswa(){
        return $this->belongsToMany('App\Models\Siswa','role');
    }
}
