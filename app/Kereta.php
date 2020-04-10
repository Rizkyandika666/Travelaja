<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kereta extends Model
{
    protected $fillable = [
    	'nama_kereta', 'partner', 'kode_kereta', 'harga', 'kursi_ekonomi', 'kursi_bisnis', 'kursi_vip', 'status'
    ];
}
