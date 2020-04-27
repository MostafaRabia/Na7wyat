<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Exams;
use App\Process;
use App\Messages;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Laravel\Facades\Telegram;
use File;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
    	/*$Today = date_create('now');
        $getExams = Exams::get();
        $schedule->call(function() use ($getExams,$Today){
        	foreach ($getExams as $Exam){
                if ($Exam->is_unlimted!=1){
                    if ($Exam->dateTo!=null){
                        $dateFrom = date_create_from_format('j F, Y H:i',$Exam->dateFrom.' '.$Exam->timeFrom);
                        $dateTo = date_create_from_format('j F, Y H:i',$Exam->dateTo.' '.$Exam->timeTo);
                        if ($Exam->avil==1&&date_diff($Today,$dateFrom)->invert==0&&date_diff($Today,$dateTo)->invert==0){
                            $Exam->avil = 0;
                            $Exam->save();
                        }
                        if ($Exam->avil==0&&date_diff($Today,$dateFrom)->invert==1&&date_diff($Today,$dateTo)->invert==0){
                            $Exam->avil = 1;
                            $Exam->save();
                        }elseif ($Exam->avil==1&&date_diff($Today,$dateTo)->invert==1){
                            $Exam->avil = 0;
                            $Exam->save();
                        }
                    }
                }
	        }
        });*/
        $schedule->call(function(){
            $date = Carbon::parse(Carbon::now());
            $getProcess = Process::chunkById(50,function($process50) use ($date){
                foreach($process50 as $process){
                    $dateProcess = Carbon::parse($process->time);
                    if (($process->date==$date->dayOfWeek||$process->date2==$date->dayOfWeek)&&$dateProcess->hour==$date->hour&&$dateProcess->minute==$date->minute){
                        $message = Messages::where('for_weak',$process->weak)->inRandomOrder()->first();
                        if ($message){
                            Telegram::sendMessage([
                                'chat_id' => $process->id_telegram,
                                'text' => $message->message,
                            ]);
                        }
                        if ($process->date2>$process->date){
                            if ($process->date2==$date->dayOfWeek){
                                $process->update(['weak'=>$process->weak+1]);
                            }
                        }else if ($process->date2==$process->date){
                            $process->update(['weak'=>$process->weak+1]);
                        }else{
                            if ($process->date2<$process->date){
                                if ($process->date==$date->dayOfWeek){
                                    $process->update(['weak'=>$process->weak+1]);
                                }
                            }
                        }
                    }
                }
            });
        })->everyMinute()->name('send')->withoutOverlapping()->runInBackground();;
        DB::disconnect();
        
        $schedule->call(function(){
            $files = Storage::disk('backup')->files('Na7wyat');
            Storage::disk('backup')->delete($files);
        })->daily();
        $schedule->command('backup:run',['--only-db'])->daily();
        $schedule->call(function(){
            $files = Storage::disk('backup')->files('Na7wyat');
            $file = explode('/',$files[0]);
            $filename = $file[1];
            $filePath = public_path('backup/Na7wyat/'.$filename);
            $fileData = File::get($filePath);
            Storage::cloud()->put($filename,$fileData);
        })->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
