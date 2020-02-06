<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $table = "airports";
    protected $fillable = [
    	'nama_bandara', 'town_id', 'kota', 'kode', 'status'
    ];

    public function towns(){
    	return $this->belongsTo(Town::class);
    }
}
