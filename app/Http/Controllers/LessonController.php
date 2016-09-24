<?php
namespace App\Http\Controllers;
use App\User;
use App\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function getLessonVocabulary($lesson_id)
    {
        //check if lesson come from the course user has premissions to

        $words = Word::all()->where('language_id', 2);
        $result = [];
        foreach($words as $word){
            $translation = [];
            foreach($word->translations as $t){
                array_push ( $translation , Word::find($t->word_to_id)->word);
            }
            $result[$word->word] = $translation;
        }
        /*
        $words = Word::all()->where('language_id', 2);
        $result = [];
        foreach($words as $word){
            $translation = $word->translations->first();
            array_push ( $result , $word->word);
        }

        $result2 = [];
        foreach($words as $word){
            $translation = $word->translations->first();
            $word123 = Word::find($translation->word_to_id)->word;
            array_push ( $result2 , $word123);
        }
        */

        return view('vocabulary.introduction', ['translations' => $result]);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
