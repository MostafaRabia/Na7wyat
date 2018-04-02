<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $table = 'members';
    public $timestamps = false;
    protected $fillable = [
        'id_member'
    ];
}
