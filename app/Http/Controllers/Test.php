<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Process;
use App\Messages;
use Carbon\Carbon;

class Test extends Controller
{
    public function test(){
        /*$getProcess = Process::get();
        $date = Carbon::parse(Carbon::now());
        foreach($getProcess as $process){
            if ($process->date==$date->dayOfWeek){
                $message = Messages::where('for_weak',$process->weak)->inRandomOrder()->first();
                Telegram::sendMessage([
                    'chat_id' => $process->id_telegram,
                    'text' => $message->message,
                ]);
            }
        }*/

        $date = Carbon::parse(Carbon::now());
        $getProcess = Process::chunk(50,function($process50) use ($date){
            foreach($process50 as $process){
                if ($process->date==$date->dayOfWeek){
                    $message = Messages::where('for_weak',$process->weak)->inRandomOrder()->first();
                    Telegram::sendMessage([
                        'chat_id' => $process->id_telegram,
                        'text' => $message->message,
                    ]);
                }
            }
        });
    }
}
