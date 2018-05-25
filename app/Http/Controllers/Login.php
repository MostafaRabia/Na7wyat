<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Users;
use App\Member;
use Auth;

class Login extends Controller
{
	public function Redirect(){
		return Socialite::driver('facebook')->redirect();
	}
	public function Callback(){
		$userProvide = Socialite::driver('facebook')->user();
		$Exist = Users::where('id_user',$userProvide->getId())->first();
		$Login = false;
		$Admin = false;
		$Facebook = false;
		//return redirect('getusers/'.$userProvide->token);
		if ($Exist){
			Auth::loginUsingId($Exist->id,true);
			if(auth()->user()->admin==1){
				$Islam = true;
			}else{
				$Login = true;
			}
			/*if (auth()->user()->admin==2){
				session()->put('token',$userProvide->token);
			}*/
		}else{
			if ($Facebook==false){
				$Add = new Users;
					$Add->id_user = $userProvide->getId();
					$Add->username = $userProvide->getName();
					$Add->profile = $userProvide->user['link'];
					$Add->admin = 0;
				$Add->save();
				Auth::loginUsingId($Add->id,true);
				$Login = true;
			}else{
				$existIdMember = Member::where('id_member',$userProvide->getId())->first();
				if ($existIdMember){
					$Add = new Users;
						$Add->id_user = $userProvide->getId();
						$Add->username = $userProvide->getName();
						$Add->admin = 0;
					$Add->save();
					Auth::loginUsingId($Add->id,true);
					$Login = true;
				}else{
	            	return redirect('/')->with('Error',true)->with('pModal',trans('Modal.pNotMember'));
				}
			}
		}
		if ($Login==true){
			return redirect('profile/myexams');
		}
		if ($Islam==true){
			return redirect('exams');
		}
	}
}
