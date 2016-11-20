<?php
namespace App\Http\Controllers;
use App\User;
use App\Translation;
use App\Word;
use App\Lesson;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class WordController extends Controller
{
    public function postFetchWordTranslation(Request $request)
    {
           $translations = Translation::all()->where('word_from_id',$request['wordId']);
            $words = [];
            foreach($translations as $t){
                $word = Word::all()->where('id', $t->word_to_id)->first();
                array_push ( $words , $word );
            }
            return response()->json(['translatedWords'=>$words],200);
    }

    public function postFetchWordTranslationBack(Request $request)
    {
        $translations = Translation::all()->where('word_to_id',$request['wordId']);
        $words = [];
        foreach($translations as $t){
            $word = Word::all()->where('id', $t->word_from_id)->first();
            array_push ( $words , $word );
        }
        return response()->json(['translatedWords'=>$words],200);
    }

    public function postAddWord(Request $request){

        for($i = 1; $i< 6;$i++){
            if(!empty($request['word_'.$i])){
                $wordFrom = new Word();
                $wordFrom->word = $request['word_'.$i];
                $wordFrom->language_id = $request['from_lang'];
                $wordFrom->save();

                $wordTo = new Word();
                $wordTo->word = $request['translation_'.$i];
                $wordTo->language_id = $request['to_lang'];
                $wordTo->save();

                $translation = new Translation();
                $translation->word_from_id = $wordFrom->id;
                $translation->word_to_id = $wordTo->id;
                $translation->save();

                Lesson::find($request['lesson'])->words()->attach($wordFrom->id);
            }
        }
    }

    public function postAddTask(Request $request){

        for($i = 1; $i< 6;$i++){
            if(!empty($request['task_'.$i])){
                $task = new Task();
                $task->task = $request['task_'.$i];
                $task->answer = $request['answer_'.$i];
                $task->lesson_id = $request['lesson'];
                $task->save();

            }
        }
    }
}
