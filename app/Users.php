<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = [
        'id_user', 'username', 'profile',
        'admin', 'telegram_id'
    ];

    public function Telegram(){
        return $this->hasOne('App\Process','id_user','id');
    }
}
