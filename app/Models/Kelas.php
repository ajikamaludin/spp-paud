<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $table = 'kelas';

    protected $fillable = [
        'periode_id',
        'nama'
    ];

    public function siswa(){
        return $this->hasMany('App\Models\Siswa','kelas_id','id');
    }

    public function periode(){
        return $this->hasOne('App\Models\Periode','id','periode_id');
    }
}
