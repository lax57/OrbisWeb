<?php
namespace App\Http\Controllers;
use App\User;
use App\Translation;
use App\Word;
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
}
