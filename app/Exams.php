<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Exams extends Authenticatable
{
    protected $table = 'exams';
    protected $fillable = [
        'name', 'time', 'dateFrom',
        'dateTo', 'timeFrom', 'timeTo',
        'rand', 'showDegree','avil',
        'isTime', 'isPage', 'quesToShow',
        'sections', 'isBack', 'is_unlimted'
    ];

    public function Ques(){
        return $this->hasMany('App\Ques','id_exam');
    }
}
