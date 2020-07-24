<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    protected $fillable = [
        'user_id',
        'qr_code'
    ];

    public function users()
    {
    	return $this->belongsToMany(\App\User::class,'user_present');
    }
}
