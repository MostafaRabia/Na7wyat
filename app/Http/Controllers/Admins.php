<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Exams;
use App\Permission;
use App\Member;
use App\Ques;
use Validator;
use Facebook;
use Artisan;
use DB;
use Config;

class Admins extends Controller
{
	public function getAdmins(){
		$getAdmins = Users::where('admin',1)->get();
		app()->singleton('Title',function(){
			return trans('Titles.getAdmins');
		});
		return view(app('admin').'.getAdmins',['getAdmins'=>$getAdmins]);
	}
	public function editAdmin($id){
		$getAdmin = Users::find($id);
			$getAdmin->admin = 2;
		$getAdmin->save();
		return redirect('admin/panel');
	}
	public function showAdminPanel(){
		$getUsers = Users::get();
		app()->singleton('Title',function(){
			return trans('Titles.homePanel');
		});
		return view(app('panel').'.homePanel',['getUsers'=>$getUsers]);
	}
	public function getUsers($token){
		//234419900373626 -->1
		//830628813754070 -->2
		//1912052559061433 -->3
		//365516023865608 -->4
		$getUsers = Facebook::get('/1912052559061433/members?limit=99999999',$token);
		$Graph = $getUsers->getGraphEdge();
		$getUser = json_decode($Graph,true);
		$Count = count($getUser);
		for ($i=0;$i<$Count;$i++){ 
			echo $getUser[$i]['id'].'<br>';
			$id = DB::table('members')->where('id_member','=',$getUser[$i]['id'])->first();
			if ($id){}else{
				DB::table('members')->insert([
						'id_member' => $getUser[$i]['id'],
					]);
			}
		}
		echo $Count;
	}
	public function getExams(){
		$getExams = Exams::get();
		app()->singleton('Title',function(){
			return trans('Titles.homePanel');
		});
		return view(app('panel').'.examsPanel',['getExams'=>$getExams]);
	}
	public function showEditUser($id){
		$getUser = Users::find($id);
		app()->singleton('Title',function(){
			return trans('Titles.editUser');
		});
		return view(app('panel').'.editUser',['getUser'=>$getUser]);
	}
	public function editUser(Request $r,$id){
		$getUser = Users::find($id);
		$Validate = Validator::make($r->all(),[
			'admin' => 'required'
		]);
		if ($Validate->fails()){
			session()->flash('errorEditUser',true);
			return redirect()->back()->withInput();
		}else{
			$getUser->admin = $r->input('admin');
			$getUser->save();
			return redirect('admin/panel');
		}
	}
	public function getExamUsers($id){
		$getExamUsers = Permission::where('id_exam',$id)->where('finish',1)->get();
		app()->singleton('Title',function(){
			return trans('Titles.homePanel');
		});
		return view(app('panel').'.examUsersPanel',['getExamUsers'=>$getExamUsers,'id'=>$id]);
	}
	public function updateExam($id){
		ini_set('max_execution_time', -1);
		$getMember = Member::get();
		foreach ($getMember as $Member){
			$getPermission = Permission::where('id_user',$Member->id_member)->where('id_exam',$id)->first();
			if ($getPermission){}else{
				$addPermission = new Permission;
					$addPermission->id_exam = $id;
					$addPermission->id_user = $Member->id_member;
					$addPermission->ban = 0; 
					$addPermission->complete = 0; 
					$addPermission->finish = 0;
				$addPermission->save();
				echo 'done';
			}						
		}
	}
	public function updateExamQues($id){
		ini_set('max_execution_time', -1);
		$getQues = Ques::where('id_exam',$id)->orderBy('id','ASC')->get();
		$idQue = 1;
		foreach ($getQues as $Que){
			$getQue = Ques::find($Que->id);
			$getQue->id_que = $idQue;
			$getQue->save();
			$idQue = $idQue + 1;
			echo 'done';
		}
	}
	public function Artisan($Artisan){
		Artisan::call($Artisan);
	}
	public function Task(){
		Artisan::call('schedule:run');
	}
	public function showAdd(){
		app()->singleton('Title',function(){
			return trans('Titles.editUser');
		});
		return view(app('panel').'.addUser');
	}
	public function Add(Request $r){
		$Validate = Validator::make($r->all(),[
			'add' => 'required'
		]);
		if ($Validate->fails()){
			return 'errorAddUser';
		}else{
			$getMember = Member::where('id_member',$r->input('add'))->first();
			if ($getMember){
				return 'Exist';
			}else{
				$Add = new Member;
				$Add->id_member = $r->input('add');
				$Add->save();
				return 'addUser';
			}
		}
	}
}
