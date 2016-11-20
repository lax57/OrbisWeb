<?php
namespace App\Http\Controllers\Api;

use App\Repetition;
use App\User;
use App\Course;
use App\Orbis\Transformers\RepetitionTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiRepetitionController extends ApiController {

    protected $repetitionTransformer;

    function __construct(RepetitionTransformer $repetitionTransformer)
    {
        $this->repetitionTransformer = $repetitionTransformer;
    }

    public function getRepetitions($user_id, $course_id)
    {
        $repetitions = User::find($user_id)
            ->courses()
            ->where('course_id', $course_id)
            ->get()->first()
            ->repetitions;

        return $this->respond([
                'repetitions' => $this->repetitionTransformer->transformCollection ($repetitions->all()),
            ]);
    }

    public function updateRepetition(Request $request)
    {
        $date = date('Y-m-d');


        $repetition = Repetition::find($request['repId']);
        $repetition->next_repetition = $date;
        $repetition->last_repetition = $date;
        $repetition->repetition_count = 0;

        $repetition->save();

        return response()->json(['next_repetition'=>$repetition->next_repetition],200);

    }

    public function getAuthUserRepetitions($course_id){
        $date = date('Y-m-d');
        $repetitions = Auth::User()->repetitions->where('excercise_type', 'App\Word')->where('next_repetition','<=',$date)->where('course_id',$course_id);
        return $this->respond($this->repetitionTransformer->transformCollection ($repetitions->all())
            );
    }
}

