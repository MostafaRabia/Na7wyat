<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exams;
use App\Permission;
use App\Ques;
use App\Users;
use App\Results;

class Index extends Controller
{
	public function Home(){
		/*$getFinsh = Permission::where('id_exam',3)->where('finish',1)->get();
		foreach ($getFinsh as $Finish){
			$getUsersFinish = Users::where('id_user',$Finish->id_user)->first();
			$getResults = Results::where('id_user',$getUsersFinish['id'])->where('id_exam',3)->sum('degree');
			if ($getResults>20){
				echo $getUsersFinish->username.' ---> ';
				echo $getResults;
				echo "<Br>";
			}
		}
		return;*/
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
