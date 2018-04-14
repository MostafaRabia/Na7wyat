<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Ques extends Authenticatable
{
    protected $table = 'ques';
    protected $fillable = [
        'id_exam', 'id_que', 'id_query',
        'ques', 'ans1', 'ans2',
        'ans3', 'ans4', 'ans5',
        'ans6', 'ans7', 'ans8',
        'correct', 'degree'
    ];
    public function Exam(){
    	return $this->belongsTo('App\Exams','id_exam');
    }
}
