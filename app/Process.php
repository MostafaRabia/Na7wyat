<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Process extends Authenticatable
{
    protected $table = 'process';
    protected $fillable = [
        'id_user', 'id_telegram', 'name',
        'date', 'weak', 'date2'
    ];

    public function User(){
        return $this->hasOne('App\Users','id','id_user');
    }
}
