<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
	protected $table = 'towns';

 	protected $fillable = [
 		'nama_kota', 'status'
 	];

	public function airports(){
		return $this->hasMany(Airport::class);
	} 

	public function stasiuns(){
		return $this->hasMany(Stasiun::class);
	}  
}
