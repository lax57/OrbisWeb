<?php
namespace App\Http\Controllers;
use App\User;
use App\Repetition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RepetitionController extends Controller
{
    public function postSetRepetition(Request $request)
    {
        $date = date('Y-m-d');


        $repetition = new Repetition;
        $repetition->excercise_type = $request['type'];
        $repetition->user_id = Auth::User()->id;
        $repetition->excercise_id = $request['excerciseId'];
        $repetition->course_id = $request['courseId'];
        $repetition->next_repetition = $date;
        $repetition->last_repetition = $date;
        $repetition->repetition_count = 0;

        $repetition->save();

        return response()->json(['next_repetition'=>$repetition->next_repetition], 200);
    }

    public function postUpdateRepetition(Request $request)
    {
        $date = date('Y-m-d');


        $repetition = Repetition::find($request['repId']);
        $repetition->next_repetition = $date;
        $repetition->last_repetition = $date;
        $repetition->repetition_count = 0;

        $repetition->save();

        return response()->json(['next_repetition'=>$repetition->next_repetition],200);
    }


    public function getWordRepetitions(Request $request)
    {
        $date = date('Y-m-d');
        $repetitions = Repetition::where('course_id', $request['course_id'])->where('excercise_type','App\Word')->where('user_id', Auth::User()->id)->where('next_repetition', $date)->take($request['rep_number'])->get();

        $words = $repetitions -> map(function ($repetition) {
            return $repetition->excercise;
        });

        return view('vocabulary.translation', ['words' => $words, 'repetitions'=>$repetitions,'lesson_id'=>0,'excCount' =>0,'course_id' => $request['course_id']]);
    }

    public function getGrammarRepetitions(Request $request)
    {
        $date = date('Y-m-d');
        $repetitions = Repetition::where('course_id', $request['course_id'])->where('excercise_type','App\Task')->where('user_id', Auth::User()->id)->where('next_repetition', $date)->take($request['rep_number'])->get();;

        $tasks = $repetitions -> map(function ($repetition) {
            return $repetition->excercise;
        });

        return view('vocabulary.task', ['tasks' => $tasks, 'repetitions'=>$repetitions,'lesson_id'=>0, 'excCount' =>0 ,'course_id' => $request['course_id']]);
    }

}
