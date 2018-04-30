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
		if ($getPermission){}else{
			$addPermissiin = new Permission;
				$addPermissiin->id_exam = $getId->id;
				$addPermissiin->id_user = auth()->user()->id_user;
				$addPermissiin->complete = 0;
				$addPermissiin->finish = 0;
				$addPermissiin->ban = 0;
			$addPermissiin->save();
			$getPermission = Permission::where('id_exam',$getId->id)->where('id_user',auth()->user()->id_user)->first();
		}
		$countQues = Ques::where('id_exam',$getId->id)->count();
		$getResults = [];
		if ($getId->isBack==1){
			$getResults = Results::where('id_exam',$getId->id)->where('question','<=',$getPermission->complete+$getId->quesToShow)->where('question','>',$getPermission->complete)->where('id_user',auth()->user()->id)->take($getId->quesToShow)->get();
		}
		if ($getPermission->finish==1){
			return redirect()->back();
		}
		if ($getId->avil==0){
			if ($getPermission->complete<$countQues&&$getPermission->finish==0){}else if ($getPermission->complete==$countQues&&$getPermission->finish==1){
				return redirect()->back();
			}else if ($getPermission->complete==0&&count($getResults)==0){
				return redirect()->back();
			}
		}
		if ($getId->rand==0){
			if ($getId->isPage==1){
				$getQues = Ques::where('id_exam',$getId->id)->where('id_que','<=',$getPermission->complete+$getId->quesToShow)->where('id_que','>',$getPermission->complete)->take($getId->quesToShow)->get();
			}else{
				$getQues = Ques::where('id_exam',$getId->id)->orderBy('id_que','ASC')->get();
			}
		}else{
			$getQues = Ques::where('id_exam',$getId->id)->inRandomOrder()->get();
		}
		app()->singleton('Title',function() use ($Name){
			return $Name.' | '.trans('Titles.nameOfWebSite');
		});
		return view(app('users').'.showExamSelect',['getQues'=>$getQues,'name'=>$Name,'getPermission'=>$getPermission,'getId'=>$getId,'countQues'=>$countQues,'getResults'=>$getResults]);
	}
	public function enterExam(Request $r,$Name){
		$getId = Exams::where('name',$Name)->first();
		$isPage = $getId->isPage;
		$getQues = Ques::where('id_exam',$getId->id)->count();
		$Redirect = false;
		foreach ($r->all() as $key => $value){
			if ($key=='_token'){continue;}
			$explode = explode('_',$key);
			if ($isPage==1){
				Permission::where('id_user',auth()->user()->id_user)->where('id_exam',$getId->id)->update(['complete'=>$explode[1]]);
			}
			$getQue = Ques::where('id_que',$explode[1])->where('id_exam',$getId->id)->first();
			$addResult = Results::where('id_exam',$getId->id)->where('question',$explode[1])->where('id_user',auth()->user()->id)->first();
			if (!$addResult){
				$addResult = new Results;
			}
			if (isset($getQue->correct)){
				if ($value==$getQue->correct){
					$Right = 1;
					$Degree = $getQue->degree;
				}else{
					$Right = 0;
					$Degree = 0;
				}
			}else{
				$Right = 2;
				$Degree = 0;
			}
				$addResult->id_exam = $getId->id;
				$addResult->id_user = auth()->user()->id;
				$addResult->question = $getQue->id_que;
				$addResult->answer = $value;
				$addResult->notes = '----';
				$addResult->result = $Right;
				$addResult->degree = $Degree;
			$addResult->save();
		}
		$getPermission = Permission::where('id_exam',$getId->id)->where('id_user',auth()->user()->id_user)->first();
		if ($isPage==1&&$getPermission->complete<$getQues&&$getPermission->complete!=$getQues-$getId->quesToShow){
			$Redirect = false;
		}else if ($isPage==1&&$getPermission->complete==$getQues){
			Permission::where('id_user',auth()->user()->id_user)->where('id_exam',$getId->id)->update(['finish'=>1]);
			$Redirect = true;
		}else if ($isPage==0){
			Permission::where('id_user',auth()->user()->id_user)->where('id_exam',$getId->id)->update(['finish'=>1]);
			$Redirect = true;
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
		$getPermission = Permission::where('id_exam',$getId->id)->where('id_user',auth()->user()->id_user)->first();
		$notFinish = 0;
		if ($getId->isBack==1&&$getPermission->finish==0){$notFinish = 1;}
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
		return view(app('users').'.Results',['getResults'=>$getResults,'getCorrectAns'=>$getCorrectAns,'getCorrectAnsWithCorrect'=>$getCorrectAnsWithCorrect,'getFailAns'=>$getFailAns,'getFailAnsWithCorrect'=>$getFailAnsWithCorrect,'getPendings'=>$getPendings,'getDegreesResults'=>$getDegreesResults,'getDegreesQues'=>$getDegreesQues,'notFinish'=>$notFinish]);
	}
	public function Back($Name){
		$getId = Exams::where('name',$Name)->first();
		if ($getId->isBack==1){}else{return redirect()->back();}
		$isPage = $getId->isPage;
		$getPermission = Permission::where('id_exam',$getId->id)->where('id_user',auth()->user()->id_user)->first();
		if ($isPage==1&&$getPermission->complete!=0){
			Permission::where('id_user',auth()->user()->id_user)->where('id_exam',$getId->id)->update(['complete'=>$getPermission->complete-$getId->quesToShow]);
		}
		return redirect('exam/'.$getId->name);
	}
}
