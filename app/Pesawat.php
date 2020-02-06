<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesawat extends Model
{
    protected $fillable = [
    	'nama_pesawat', 'partner', 'kode_pesawat', 'harga', 'kursi_ekonomi', 'kursi_bisnis', 'kursi_vip', 'status'
    ];
}
