<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Orbis\Transformers\CourseTransformer;

class ApiCourseController extends ApiController {

    protected $coursesTransformer;

    function __construct(CourseTransformer $coursesTransformer)
    {
        $this->courseTransformer = $coursesTransformer;
    }

    public function getUserCourses($user_id)
    {
        $courses =  User::find($user_id)->courses;
        return response()->json([
                'data' => $courses,
            ], 200);
    }

    public function getAuthUserCourses()
    {
        $courses =  Auth::User()->courses;
        return response()->json($this->courseTransformer->transformCollection ($courses->all())
            , 200);
    }
}
