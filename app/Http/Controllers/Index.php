<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exams;

class Index extends Controller
{
	public function Home(){
		app()->singleton('Title',function(){
			return trans('Titles.Home');
		});
		$getExams = Exams::where('avil',1)->orderBy('id','DESC')->first();
		return view(app('users').'.Home',['getExams'=>$getExams]);
	}
	public function Logout(){
		auth()->logout();
		return redirect('/');
	}
}
