<?php
namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    private function getUniqueLanguages($courses){
        $user_unique_languages =[];
        foreach($courses as $course){
            $lang = $course->language;
            if(!in_array($lang, $user_unique_languages)) { array_push($user_unique_languages, $lang); }
        }
        return $user_unique_languages;
    }

    private function getUniqueLevels($courses){
        $user_unique_levels =[];
        foreach($courses as $course){
            $level = $course->level;
            if(!in_array($level, $user_unique_levels)) { array_push($user_unique_levels, $level); }
        }
        return $user_unique_levels;
    }

    public function getUserCourses()
    {
        if (count(Auth::User()->courses)>0) {
            $user_courses = Auth::User()->courses;

            $user_unique_languages = $this->getUniqueLanguages($user_courses);
            $user_unique_levels = $this->getUniqueLevels($user_courses);

            return view('user_courses', ['user_courses' => $user_courses, 'courses' => $user_courses, 'unique_languages' => $user_unique_languages, 'unique_levels' => $user_unique_levels]);
        } else {
            $data['message'] = trans('empty_page.message');
            $data['submessage'] = trans('empty_page.submessage');
            $data['user_courses'] = [];
            return view('empty_page', $data);
        }
    }

    public function getAllCourses()
    {
        $all_courses = Course::all();
        $user_courses = Auth::User()->courses;

        $all_unique_languages = $this->getUniqueLanguages($all_courses);
        $all_unique_levels = $this->getUniqueLevels($all_courses);

        return view('all_courses', ['courses' => $all_courses, 'unique_languages' => $all_unique_languages, 'unique_levels' => $all_unique_levels]);
    }

    public function getCoursePage($course_id)
    {
        $user_courses = Auth::User()->courses;
        $course = Auth::User()->courses()->where('course_id', $course_id)->first();
        if($course){
            return view('course_page', ['course'=>$course]);
        } else {
            return redirect()->back();
        }
    }

    public function postCourseSignUp(Request $request)
    {
        $user = Auth::User();
        $user->courses()->attach($request['courseId']);
        return response()->json(200);
    }

    public function postCourseSignOut(Request $request)
    {
        $user = Auth::User();
        $user->courses()->detach($request['courseId']);
        return response()->json(['url'=>route('user_courses')],200);
    }

    public function getLessons()
    {
        return view("lessons_overview");
    }

    public function getVocabularyIntro()
    {
        return view("vocabulary.introduction");
    }

    public function getVocabularyListen()
    {
        return view("vocabulary.listen");
    }

    public function getVocabularyTranslation()
    {
        return view("vocabulary.translation");
    }

}
