<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Messages extends Authenticatable
{
    protected $table = 'messages';
    protected $fillable = [
        'id', 'message', 'for_weak'
    ];
}
