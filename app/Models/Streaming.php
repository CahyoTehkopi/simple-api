<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Streaming extends Model
{
	protected $guarded = ['id'];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }
}
