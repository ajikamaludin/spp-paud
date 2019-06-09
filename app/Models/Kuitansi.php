<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kuitansi extends Model
{
    protected $table = 'kuitansi';

    protected $fillable = [
        'invoice',
        'items',
        'total'
    ];
}
