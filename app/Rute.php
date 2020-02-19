<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
	protected $table = 'rutes';
	protected $fillable = [
		'transportasi', 'asal', 'tujuan', 'jalur', 'berangkat', 'pulang', 'durasi'
	];   
}
