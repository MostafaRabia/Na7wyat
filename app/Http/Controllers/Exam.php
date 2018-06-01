<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exams;
use App\Results;
use App\Users;
use App\Ques;
use App\Permission;
use App\Member;
use Validator;
use Illuminate\Validation\Rule;

class Exam extends Controller
{
	public function showExams(){
		app()->singleton('Title',function(){
			return trans('Titles.Exam');
		});
		$getExams = Exams::orderBy('id','desc')->get();
		return view(app('admin').'.Exam',['getExams'=>$getExams]);
	}
	public function showCreateExam($id=null){
		app()->singleton('Title',function(){
			return trans('Titles.createExam');
		});
		return view(app('admin').'.Create',['id'=>$id]);
	}
	public function createExam(Request $r){
		$Validate = Validator::make($r->all(),[
				'name' => 'required|unique:exams,name',
				'show' => 'required',
				'dateFrom' => 'required',
				'dateTo' => 'required',
				'timeFrom' => 'required',
				'timeTo' => 'required',
				'isTime' => 'required',
				'page' => 'required',
			]);
		$Rand = 0;
		if ($r->input('rand')=='yes'){
			$Rand = 1;
		}else{
			$Rand = 0;
		}
		$Time = 1;
		if ($r->input('isTime')=='no'){
			$Time = 0;
		}else{
			$Time = 1;
		}
		$Show = 0;
		if ($r->input('show')=='yes'){
			$Show = 1;
		}else{
			$Show = 0;
		}
		$Page = 0;
		if ($r->input('page')=='yes'){
			$Page = 1;
		}else{
			$Page = 0;
			$Back = 0;
		}
		$Back = 0;
		if ($r->input('back')=='yes'){
			$Back = 1;
		}else{
			$Back = 0;
		}
		$quesToShow = 1;
		if ($r->input('quesToShowSelect')=='yes'){
			$quesToShow = $r->input('quesToShow');
		}else{
			$quesToShow = 1;
		}
		if ($Validate->fails()){
			session()->flash('errorCreateExam',true);
			return redirect()->back()->withInput();
		}else{
			$addExam = new Exams;
				$addExam->name = $r->input('name');
				$addExam->time = $r->input('time');
				$addExam->dateFrom = $r->input('dateFrom');
				$addExam->dateTo = $r->input('dateTo');
				$addExam->timeFrom = $r->input('timeFrom');
				$addExam->timeTo = $r->input('timeTo');
				$addExam->avil = 0;
				$addExam->rand = $Rand;
				$addExam->showDegree = $Show;
				$addExam->isTime = $Time;
				$addExam->isPage = $Page;
				$addExam->quesToShow = $quesToShow;
				$addExam->isBack = $Back;
			$addExam->save();
			$idExam = $addExam->id;
			/*$getMembers = Member::get();
			ini_set('max_execution_time', -1);
			foreach ($getMembers as $Member){
				$addPermissiin = new Permission;
					$addPermissiin->id_exam = $idExam;
					$addPermissiin->id_user = $Member->id_member;
					$addPermissiin->complete = 0;
					$addPermissiin->finish = 0;
					$addPermissiin->ban = 0;
				$addPermissiin->save();
			}*/
			return redirect('create/exam/'.$idExam);
		}
	}
	public function createQuesExam(Request $r,$id){
		$getIdQue = Ques::where('id_exam',$id)->orderBy('id_que','DESC')->first();
		$getExam = Exams::find($id);
		if($getIdQue){
			$idQue = $getIdQue->id_que + 1;
		}else{
			$idQue = 1;
		}
		$Section = ceil($idQue / $getExam->quesToShow);
		$Validate = Validator::make($r->all(),[
				'ques' => 'required',
			]);
		if ($Validate->fails()){
			return 'errorCreateQue';
		}else{
			if ($r->has('correct')){
				$Correct = explode('.',$r->input('correct'));
				$ansCorrect = $r->input($Correct[0]);
			}else{
				$ansCorrect = null;
			}
			$getExam->sections = $Section;
			$getExam->save();
			$addQues = new Ques;
				$addQues->id_exam = $id;
				$addQues->id_que = $idQue;
				$addQues->ques = $r->input('ques');
				$addQues->ans1 = $r->input('ans1');
				$addQues->ans2 = $r->input('ans2');
				$addQues->ans3 = $r->input('ans3');
				$addQues->ans4 = $r->input('ans4');
				$addQues->ans5 = $r->input('ans5');
				$addQues->ans6 = $r->input('ans6');
				$addQues->ans7 = $r->input('ans7');
				$addQues->ans8 = $r->input('ans8');
				$addQues->correct = $ansCorrect;
				$addQues->degree = $r->input('degree');
			$addQues->save();
			return 'addQue';
		}
	}
	public function showEditExam($id){
		app()->singleton('Title',function(){
			return trans('Titles.editExam');
		});
		$getExam = Exams::find($id);
		$getQues = Ques::where('id_exam',$id)->get();
		return view(app('admin').'.showEdit',['getExam'=>$getExam,'getQues'=>$getQues]);
	}
	public function showEditExamQuestion($id){
		app()->singleton('Title',function(){
			return trans('Titles.editExamQuestion');
		});
		$getQue = Ques::find($id);
		return view(app('admin').'.Edit',['getQue'=>$getQue]);
	}
	public function editExam(Request $r,$id){
		$getQuesAndExam = Ques::find($id);
		$countQues = Ques::where('id_exam',$getQuesAndExam->id_exam)->count();
		$Validate = Validator::make($r->all(),[
				'name' => [
					'required',
					Rule::unique('exams')->ignore($getQuesAndExam->Exam->id),
				],
				'ques' => 'required',
				'show' => 'required',
				'dateFrom' => 'required',
				'dateTo' => 'required',
				'timeFrom' => 'required',
				'timeTo' => 'required',
				'isTime' => 'required',
				'page' => 'required'
			]);
		$Rand = 0;
		if ($r->input('rand')=='yes'){
			$Rand = 1;
		}else{
			$Rand = 0;
		}
		$Time = 1;
		if ($r->input('isTime')=='no'){
			$Time = 0;
		}else{
			$Time = 1;
		}
		$Show = 0;
		if ($r->input('show')=='yes'){
			$Show = 1;
		}else{
			$Show = 0;
		}
		$Page = 0;
		if ($r->input('page')=='yes'){
			$Page = 1;
		}else{
			$Page = 0;
			$Back = 0;
		}
		$Back = 0;
		if ($r->input('back')=='yes'){
			$Back = 1;
		}else{
			$Back = 0;
		}
		$quesToShow = 1;
		if ($r->input('quesToShowSelect')=='yes'){
			$quesToShow = $r->input('quesToShow');
		}else{
			$quesToShow = 1;
		}
		if ($Validate->fails()){
			return redirect()->back()->with('errorCreateExam',trans('Modal.pErrorCreateExam'))->withErrors($Validate)->withInput();
		}else{
			if ($r->has('correct')){
				$Correct = explode('.',$r->input('correct'));
				$ansCorrect = $r->input($Correct[0]);
			}else{
				$ansCorrect = null;
			}
			$Sections = ceil($countQues / $quesToShow);
			$getQuesAndExam->Exam->name = $r->input('name');
			$getQuesAndExam->Exam->time = $r->input('time');
			$getQuesAndExam->Exam->dateFrom = $r->input('dateFrom');
			$getQuesAndExam->Exam->dateTo = $r->input('dateTo');
			$getQuesAndExam->Exam->timeFrom = $r->input('timeFrom');
			$getQuesAndExam->Exam->timeTo = $r->input('timeTo');
			$getQuesAndExam->Exam->rand = $Rand;
			$getQuesAndExam->Exam->showDegree = $Show;
			$getQuesAndExam->Exam->isTime = $Time;
			$getQuesAndExam->Exam->isPage = $Page;
			$getQuesAndExam->Exam->quesToShow = $quesToShow;
			$getQuesAndExam->Exam->sections = $Sections;
			$getQuesAndExam->Exam->isBack = $Back;
			$getQuesAndExam->ques = $r->input('ques');
			$getQuesAndExam->ans1 = $r->input('ans1');
			$getQuesAndExam->ans2 = $r->input('ans2');
			$getQuesAndExam->ans3 = $r->input('ans3');
			$getQuesAndExam->ans4 = $r->input('ans4');
			$getQuesAndExam->ans5 = $r->input('ans5');
			$getQuesAndExam->ans6 = $r->input('ans6');
			$getQuesAndExam->ans7 = $r->input('ans7');
			$getQuesAndExam->ans8 = $r->input('ans8');
			$getQuesAndExam->correct = $ansCorrect;
			$getQuesAndExam->degree = $r->input('degree');
			$getQuesAndExam->save();
			$getQuesAndExam->Exam->save();
			return redirect('edit/exam/'.$getQuesAndExam->Exam->id);
		}
	}
	public function deleteQue($id){
		$getQues = Ques::where('id','>',$id)->get();
		foreach ($getQues as $Ques){
			$editQue = Ques::find($Ques->id);
				$editQue->id_que--;
			$editQue->save();
		}
		$Que = Ques::find($id);
		$updateResults = Results::where('id_exam',$Que->Exam->id)->where('question',$Que->id_que)->delete();
		$Que->delete();
		return redirect()->back();
	}
	public function showExam($Name){
		$getId = Exams::where('name',$Name)->first();
		if ($getId->rand==1){
			$getQues = Ques::where('id_exam',$getId->id)->inRandomOrder()->get();
		}else{
			$getQues = Ques::where('id_exam',$getId->id)->orderBy('id_que','ASC')->get();
		}
		app()->singleton('Title',function() use ($Name){
			return $Name.' | '.trans('Titles.nameOfWebSite');
		});
		return view(app('admin').'.showExamSelect',['getQues'=>$getQues,'name'=>$Name,'getId'=>$getId]);
	}
	public function showResults($id){
		$getFinsh = Permission::where('id_exam',$id)->where('finish',1)->get();
		$getExam = Exams::find($id);
		foreach ($getFinsh as $Finish){
			$getUsersFinish = Users::where('id_user',$Finish->id_user)->first();
			$usersFinish[] = $getUsersFinish;	
		}
		app()->singleton('Title',function(){
			return trans('Titles.Results');
		});
		return view(app('admin').'.usersFinish',['usersFinish'=>$usersFinish,'getExam'=>$getExam]);
	}
	public function Results($id,$User){
		$getResults = Results::where('id_exam',$id)->where('id_user',$User)->paginate(10);
		$getCorrectAns = Results::where('id_exam',$id)->where('id_user',$User)->where('result',1)->count(); 
		$getCorrectAnsWithCorrect = Results::where('id_exam',$id)->where('id_user',$User)->where('result',3)->count(); 
		$getFailAns = Results::where('id_exam',$id)->where('id_user',$User)->where('result',0)->count(); 
		$getFailAnsWithCorrect = Results::where('id_exam',$id)->where('id_user',$User)->where('result',4)->count(); 
		$getPendings = Results::where('id_exam',$id)->where('id_user',$User)->where('result',2)->count(); 
		$getDegreesResults = Results::where('id_exam',$id)->where('id_user',$User)->sum('degree');
		$getDegreesQues = Ques::where('id_exam',$id)->sum('degree');
		app()->singleton('Title',function(){
			return trans('Titles.Results');
		});
		return view(app('admin').'.Results',['getResults'=>$getResults,'getCorrectAns'=>$getCorrectAns,'getCorrectAnsWithCorrect'=>$getCorrectAnsWithCorrect,'getFailAns'=>$getFailAns,'getFailAnsWithCorrect'=>$getFailAnsWithCorrect,'getPendings'=>$getPendings,'getDegreesResults'=>$getDegreesResults,'getDegreesQues'=>$getDegreesQues]);
	}
	public function showNotes($id){
		$getResult = Results::find($id);
		app()->singleton('Title',function(){
			return trans('Titles.addNotes');
		});
		return view(app('admin').'.ShowNotes',['getResult'=>$getResult]);
	}
	public function Notes(Request $r,$id){
		$addNotes = Results::find($id);
			$addNotes->notes = $r->input('notes');
		$addNotes->save();
		return redirect('results/exam/'.$addNotes->id_exam.'/'.$addNotes->id_user);
	}
	public function Stop(Request $r,$id){
		if ($r->input('stop')=='Stop'){
			$Avil = 0;
		}else{
			$Avil = 1;
		}
		$stopExam = Exams::find($id);
			$stopExam->avil = $Avil;
		$stopExam->save();
	}
	public function showSetting($id){
		$getExam = Exams::find($id);
		$Name = $getExam->name;
		app()->singleton('Title',function() use ($Name){
			return $Name.' | '.trans('Titles.nameOfWebSite');
		});
		return view(app('admin').'.Setting',['getExam'=>$getExam]);
	}
	public function Students($id){
		$getFinsh = Permission::where('id_exam',$id)->where('finish',1)->get();
		$getExam = Exams::find($id);
		$getQues = Ques::where('id_exam',$getExam->id)->sum('degree');
		$usersFinish = [];
		$getResults = [];
		foreach ($getFinsh as $Finish){
			$getUsersFinish = Users::where('id_user',$Finish->id_user)->first();
			$usersFinish[] = $getUsersFinish;	
			$getResults[] = Results::where('id_user',$getUsersFinish['id'])->where('id_exam',$getExam->id)->sum('degree');
		}
		app()->singleton('Title',function(){
			return trans('Titles.Students');
		});
		return view(app('admin').'.Students',['usersFinish'=>$usersFinish,'getResults'=>$getResults,'getExam'=>$getExam,'getQues'=>$getQues]);
	}
	public function notStudents($id){
		$getUsers = Users::get();
		foreach ($getUsers as $User){
			$getNotFinsh = Permission::where('id_exam',$id)->where('id_user','!=',$User->id_user)->first();
			if ($getNotFinsh){}else{$getNotFinshArr[] = $User;}
		}
		$getExam = Exams::find($id);
		$usersNotFinish = [];
		foreach ($getNotFinshArr as $notFinish){
			if ($notFinish==null){continue;}
			$getUsersNotFinish = Users::where('id_user',$notFinish->id_user)->where('admin',0)->first();
			if ($getUsersNotFinish){$usersNotFinish[] = $getUsersNotFinish;}
		}
		app()->singleton('Title',function(){
			return trans('Titles.Results');
		});
		return view(app('admin').'.usersNotFinish',['usersNotFinish'=>$usersNotFinish,'getExam'=>$getExam]);
	}
	public function Result(Request $r,$id){
		$editResult = Results::find($id);
		$getDegree = $editResult->Ques->degree;
		if ($r->input('degree')>=(1/2)*$getDegree){
			$editResult->result = 3;
		}else if ($r->input('degree')<=(1/2)*$getDegree){
			$editResult->result = 4;
		}
			$editResult->degree = $r->input('degree');
		$editResult->save();
	}
	public function deleteExam($id){
		Exams::where('id',$id)->delete();
		Ques::where('id_exam',$id)->delete();
		Permission::where('id_exam',$id)->delete();
		Results::where('id_exam',$id)->delete();
		return redirect('exams');
	}
}