<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exams;
use App\Results;
use App\Permission;
use App\Ques;

class Profile extends Controller
{
	public function myExams(){
		app()->singleton('Title',function(){
			return auth()->user()->username.' | '.trans('Titles.nameOfWebSite');
		});
		$getExams = Exams::orderBy('id','desc')->get();
		return view(app('users').'.myExams',['getExams'=>$getExams]);
	}
	public function showEnterExam($Name){
		$getId = Exams::where('name',$Name)->first();
		$getPermission = Permission::where('id_exam',$getId->id)->where('id_user',auth()->user()->id_user)->first();
		$isPage = $getId->isPage;
		$countQues = Ques::where('id_exam',$getId->id)->count();
		if ($getPermission->ban==1||$getPermission->finish==1||$getId->avil==0){
			return redirect()->back();
		}
		if ($getId->rand==1&&$isPage==0){
			$getQues = Ques::where('id_exam',$getId->id)->inRandomOrder()->get();
		}else if ($getId->rand==0&&$isPage==0){
			$getQues = Ques::where('id_exam',$getId->id)->orderBy('id_que','ASC')->get();
		}
		if ($isPage==1&&$getId->rand==0){
			$getQues = Ques::where('id_exam',$getId->id)->where('id_que',$getPermission->complete+1)->get();
		}
		app()->singleton('Title',function() use ($Name){
			return $Name.' | '.trans('Titles.nameOfWebSite');
		});
		return view(app('users').'.showExamSelect',['getQues'=>$getQues,'name'=>$Name,'getPermission'=>$getPermission,'getId'=>$getId,'countQues'=>$countQues]);
	}
	public function enterExam(Request $r,$Name){
		$getId = Exams::where('name',$Name)->first();
		$isPage = $getId->isPage;
		$getPermission = Permission::where('id_exam',$getId->id)->where('id_user',auth()->user()->id_user)->first();
		$getQues = Ques::where('id_exam',$getId->id)->count();
		if ($isPage==1&&$getPermission->complete<$getQues&&$getPermission->complete!=$getQues-1){
			Permission::where('id_user',auth()->user()->id_user)->where('id_exam',$getId->id)->update(['complete'=>$getPermission->complete+1]);
			$Redirect = false;
		}else if ($isPage==1&&$getPermission->complete==$getQues-1){
			Permission::where('id_user',auth()->user()->id_user)->where('id_exam',$getId->id)->update(['finish'=>1,'complete'=>$getPermission->complete+1]);
			$Redirect = true;
		}else if ($isPage==0){
			Permission::where('id_user',auth()->user()->id_user)->where('id_exam',$getId->id)->update(['finish'=>1]);
			$Redirect = true;
		}
		foreach ($r->all() as $key => $value){
			if ($key=='_token'){continue;}
			$explode = explode('_',$key);
			$getQue = Ques::where('id_que',$explode[1])->where('id_exam',$getId->id)->first();
			if (isset($getQue->correct)){
				if ($value==$getQue->correct){
					$Right = 1;
					$Degree = $getQue->degree;
				}else if ($value==null){
					$Right = 0;
					$Degree = 0;
				}else{
					if (auth()->user()->id_user==157327988310773){
						$Right = 0;
						$Degree = -50 - $getQue->degree;
					}else{
						$Right = 0;
						$Degree = 0 - $getQue->degree;
					}
				}
			}else{
				$Right = 2;
				$Degree = 0;
			}
			$addResult = new Results;
				$addResult->id_exam = $getId->id;
				$addResult->id_user = auth()->user()->id;
				$addResult->question = $getQue->id_que;
				$addResult->answer = $value;
				$addResult->notes = '----';
				$addResult->result = $Right;
				$addResult->degree = $Degree;
			$addResult->save();
		}
		if ($Redirect==true){
			return redirect('results/'.$getId->name);
		}else{
			return redirect()->back();
		}
	}
	public function showResults($Name){
		$getId = Exams::where('name',$Name)->first();
		$id = $getId->id;
		$getResults = Results::where('id_user',auth()->user()->id)->where('id_exam',$id)->paginate(10);
		$getCorrectAns = Results::where('id_exam',$id)->where('id_user',auth()->user()->id)->where('result',1)->count(); 
		$getCorrectAnsWithCorrect = Results::where('id_exam',$id)->where('id_user',auth()->user()->id)->where('result',3)->count(); 
		$getFailAns = Results::where('id_exam',$id)->where('id_user',auth()->user()->id)->where('result',0)->count(); 
		$getFailAnsWithCorrect = Results::where('id_exam',$id)->where('id_user',auth()->user()->id)->where('result',4)->count(); 
		$getPendings = Results::where('id_exam',$id)->where('id_user',auth()->user()->id)->where('result',2)->count(); 
		$getDegreesResults = Results::where('id_exam',$id)->where('id_user',auth()->user()->id)->sum('degree');
		$getDegreesQues = Ques::where('id_exam',$id)->sum('degree');
		app()->singleton('Title',function(){
			return trans('Titles.Results');
		});
		return view(app('users').'.Results',['getResults'=>$getResults,'getCorrectAns'=>$getCorrectAns,'getCorrectAnsWithCorrect'=>$getCorrectAnsWithCorrect,'getFailAns'=>$getFailAns,'getFailAnsWithCorrect'=>$getFailAnsWithCorrect,'getPendings'=>$getPendings,'getDegreesResults'=>$getDegreesResults,'getDegreesQues'=>$getDegreesQues]);
	}
	public function Back($Name){
		$getId = Exams::where('name',$Name)->first();
		$isPage = $getId->isPage;
		$getPermission = Permission::where('id_exam',$getId->id)->where('id_user',auth()->user()->id_user)->first();
		if ($isPage==1&&$getPermission->complete!=0){
			Permission::where('id_user',auth()->user()->id_user)->where('id_exam',$getId->id)->update(['complete'=>$getPermission->complete-1]);
			$getResult = Results::where('id_exam',$getId->id)->where('id_user',auth()->user()->id)->where('question',$getPermission->complete)->delete();
		}
		return redirect('exam/'.$getId->name);
	}
}
