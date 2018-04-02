<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Results extends Authenticatable
{
    protected $table = 'results';
    protected $fillable = [
        'id_exam', 'id_user', 'question',
        'answer', 'notes', 'result',
        'degree'
    ];
    public function Exam(){
    	return $this->belongsTo('App\Exams','id_exam');
    }
    public function User(){
    	return $this->belongsTo('App\Users','id_user');
    }
    public function Ques(){
        return $this->belongsTo('App\Ques','question','id_que');
    }
}
