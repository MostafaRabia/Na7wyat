<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Process;
use Validator;
use Telegram\Bot\Laravel\Facades\Telegram;

class Processing extends Controller
{
    public function Show(){
        app()->singleton('Title',function(){
			return 'نظام المتابعة'.' | '.trans('Titles.nameOfWebSite');
		});
        return view(app('users').'.showProcess');
    }

    public function showSettings(){
        app()->singleton('Title',function(){
			return 'إعداد نظام المتابعة'.' | '.trans('Titles.nameOfWebSite');
		});
        return view(app('users').'.processSettings');
    }

    public function Settings(Request $r){
        $Validate = Validator::make($r->all(),[
            'name' => 'required',
            'date' => 'required',
            'weak' => 'required',
        ]);
        if ($Validate->fails()){
			return 'error';
        }else{
            $checkIfExist = Process::where('id_user',auth()->user()->id)->first();
            if ($checkIfExist){
                $new = $checkIfExist;
            }else{
                $new = new Process;
                $activity = Telegram::getUpdates();
                $array = array_reverse(json_decode(json_encode($activity),true));
                $i = 0;
                foreach($array as $active){
                    $i++;
                    $chatID = $active['message']['chat']['id'];
                    $name = $active['message']['chat']['first_name'];
                    if ($name==$r->name){
                        $check = Process::where('id_telegram',$chatID)->first();
                        if ($check){
                            continue;
                        }
                        $new->id_telegram = $chatID;
                        break;
                    }
                    if ($i==count($array)){
                        return 'errorName';
                    }
                }
            }
                $new->id_user = auth()->user()->id;
                $new->name = $r->name;
                $new->date = $r->date;
                $new->weak = $r->weak;
            $new->save();
            return 'done';
        }
    }

    public function Check(){
        Telegram::sendMessage([
            'chat_id' => auth()->user()->Telegram->id_telegram,
            'text' => 'إن وصلتك هذه الرسالة، فاضغط على تم الاشتراك.'
        ]);
    }
}
