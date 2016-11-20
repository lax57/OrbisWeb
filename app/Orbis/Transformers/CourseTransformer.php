<?php
namespace App\Orbis\Transformers;
use Illuminate\Support\Facades\Auth;

class CourseTransformer extends Transformer {

    public function transform($course)
    {
        return [
            'id' => (integer)$course['id'],
            'course_title' => $course['name'],
            'repetition_count' => $course->repetitions->where('user_id', Auth::User()->id)->where('excercise_type', 'App\Word')->where('next_repetition','<=',date('Y-m-d'))->count(),
        ];
    }
}
