<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exams;

class Word extends Controller
{
    public function Export($id){
        $get_exam = Exams::find($id);
        $i = 0;
        $word = new \PhpOffice\PhpWord\PhpWord();
        $new_word = $word->addSection();
        $new_word->addText($get_exam->name,['size'=>18,'bold'=>true,'name'=>'Droid Arabic Kufi'],['alignment'=>'center']);
        $new_word->addTextBreak(2);

        foreach($get_exam->Ques as $ques){
            $i++;
            $new_word->addText($i.'- '.$ques->ques,['name'=>'Droid Arabic Kufi','bold'=>true,'size'=>16],['alignment'=>'right']);

            for($c=1;$c<=8;$c++){
                $Ans = 'ans'.$c;
                if ($ques->$Ans!=null){
                    $new_word->addText('- '.$ques->$Ans,['name'=>'Droid Arabic Kufi','size'=>14],['alignment'=>'right']);
                }
            }
            if ($i!=count($get_exam->Ques)){
                $new_word->addLine(['weight'=>1,'width'=>250,'height'=>1,'color'=>000000,'flip'=>true]);
            }
        }
        $object_writer = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
        $object_writer->save(storage_path($get_exam->name.'.docx'));
        return response()->download(storage_path($get_exam->name.'.docx'));
    }
}
