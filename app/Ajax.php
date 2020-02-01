<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ajax extends Model
{
    protected $table = "ajax_crud";
    protected $fillable = [
    	'name','email'
    ];
}
