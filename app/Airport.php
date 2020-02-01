<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $table = "airports";
    protected $fillable = [
    	'nama_bandara', 'kota', 'kode', 'status'
    ];
}
