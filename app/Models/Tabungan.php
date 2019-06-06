<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabungan extends Model
{
    use SoftDeletes;

    protected $table = 'tabungan';

    protected $fillable = [
        'siswa_id',
        'tipe',
        'jumlah',
        'saldo',
        'keperluan'
    ];

    public function siswa(){
        return $this->belongsTo('App\Models\Siswa','siswa_id','id');
    }

    public function keuangan(){
        return $this->hasOne('App\Models\Keuangan','tabungan_id','id');
    }
}
