<?php
namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\Repetition;
use App\Word;
use App\Task;
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

    private function calculateCourseProgress($course){
        $wordscount = 0;
        $taskcount = 0;
        foreach(Lesson::where('course_id', $course->id)->get() as $lesson){
            $wordscount += $lesson->words->count();
            $taskcount += $lesson->tasks->count();
        }

        $repetition_count = $course->repetitions->count();
        $wordscount!==0? $course_progress = number_format(($repetition_count/($wordscount+$taskcount))*100 ,2 ): $course_progress = 0;

        return array('course_progress' => $course_progress, 'words_count'=>$wordscount, 'tasks_count'=>$taskcount);

    }

    private function getTaskReptitionCount($course){
        $date = date('Y-m-d');
        $repetition_count = $course->repetitions->where('excercise_type', 'App\Task')->where('next_repetition', $date)->count();
        return $repetition_count;
    }

    private function getWordReptitionCount($course){
        $date = date('Y-m-d');
        $repetition_count = $course->repetitions->where('excercise_type', 'App\Word')->where('next_repetition', $date)->count();
        return $repetition_count;
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
        $course = Auth::User()->courses()->where('course_id', $course_id)->first();

        if($course){
            $course_stats = $this ->calculateCourseProgress($course);
            $course_progress =$course_stats['course_progress'];
            $words_count = $course_stats['words_count'];
            $tasks_count = $course_stats['tasks_count'];
            $task_rep_count = $this ->getTaskReptitionCount($course);
            $word_rep_count = $this ->getWordReptitionCount($course);
            return view('course_page', ['course'=>$course, 'progress' =>$course_progress, 'task_rep_count' => $task_rep_count,'word_rep_count' => $word_rep_count, 'words_count' => $words_count, 'tasks_count'=>$tasks_count]);
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

    public function getLessons($course_id)
    {
        //TODO: check if user has permissions to course
        $user_id = Auth::User()->id;
        $lessons = Course::find($course_id)->lessons;

        $lessons_remeining_excercises = $lessons->map(
            function($lesson) use($user_id) {
                return [
                    'word_remaining'=>$lesson->words->filter(function($w) use($user_id, $lesson){
                                           if(!$w->hasRepetition($user_id, $lesson->course_id )){ return $w; }
                                       })->count(),
                    'task_remaining'=>$lesson->tasks->filter(function($t) use($user_id, $lesson){
                        if(!$t->hasRepetition($user_id, $lesson->course_id )){ return $t; }
                    })->count(),
                    ];
            }

            );
        return view("lessons_overview",['lessons'=>$lessons, 'lessons_remeining_excercises' =>$lessons_remeining_excercises]);
    }

}
