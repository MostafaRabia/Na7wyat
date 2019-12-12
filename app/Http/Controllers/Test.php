<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Process;
use App\Messages;
use App\Exams;
use Carbon\Carbon;
use DB;

class Test extends Controller
{
    public function test(){
        $exam = Exams::first();
        $i = 0;
        $wordTest = new \PhpOffice\PhpWord\PhpWord();
        $newSection = $wordTest->addSection();
        $newSection->addText($exam->name,['size'=>18,'bold'=>true,'name'=>'Droid Arabic Kufi'],['alignment'=>'center']);
        $newSection->addTextBreak(2);
        foreach($exam->Ques as $ques){
            $i++;
            $newSection->addText($i.'- '.$ques->ques,['name'=>'Droid Arabic Kufi','bold'=>true,'size'=>16],['alignment'=>'right']);

            for($c=1;$c<=8;$c++){
                $Ans = 'ans'.$c;
                if ($ques->$Ans!=null){
                    $newSection->addText('- '.$ques->$Ans,['name'=>'Droid Arabic Kufi','size'=>14],['alignment'=>'right']);
                }
            }
            if ($i!=count($exam->Ques)){
                $newSection->addLine(['weight'=>1,'width'=>250,'height'=>1,'color'=>000000,'flip'=>true]);
            }
        }
        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');
        $objectWriter->save(storage_path('TestWordFile.docx'));
        return response()->download(storage_path('TestWordFile.docx'));
    }
}
