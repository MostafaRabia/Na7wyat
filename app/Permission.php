<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Permission extends Authenticatable
{
    protected $table = 'permission';
    protected $fillable = [
        'id_exam', 'id_user', 'complete',
        'finish', 'ban'
    ];
    public function Exam(){
    	return $this->belongsTo('App\Exams','id_exam');
    }
}
