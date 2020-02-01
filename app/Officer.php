<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
	protected $primaryKey = 'id_petugas';
    protected $fillable = [
    	'nama_petugas', 'email', 'password', 'telepon', 'jenis_kelamin', 'alamat'
    ];
}
