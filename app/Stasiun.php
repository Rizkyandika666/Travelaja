<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stasiun extends Model
{
    protected $fillable = [
    	'nama_stasiun', 'town_id', 'kota', 'kode', 'status'
    ];

    public function towns(){
    	return $this->belongsTo(Town::class);
    }
}
