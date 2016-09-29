<?php
namespace App\Http\Controllers;
use App\User;
use App\Word;
use App\Lesson;
use App\Task;
use App\Repetition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{

    private function getLessonWords($course_id, $lesson_id, $repNo){
        //check if lesson come from the course user has premissions to
        $user_id = Auth::User()->id;
        $words = Lesson::find($lesson_id)->words->filter(function($w) use($user_id,$course_id) {
            if(!$w->hasRepetition($user_id, $course_id )){ return $w; }
        })->take($repNo)->values();

        return $words;
    }

    public function getLessonVocabularyIntro(Request $request)
    {
        $words = $this->getLessonWords($request['courseId'],$request['lessonId'], $request['repNo']);
        $first_word = $words->first();

        return view('vocabulary.introduction', ['words' => $words,'course_id' => $request['courseId'],'lesson_id' => $request['lessonId'], 'excCount'=>$request['repNo']]);
    }

    public function getLessonVocabularyListen(Request $request)
    {
        $words = $this->getLessonWords($request['courseId'],$request['lessonId'], $request['repNo']);
        $first_word = $words->first();

        return view('vocabulary.listen', ['words' => $words,'course_id' => $request['courseId'],'lesson_id' => $request['lessonId'],'excCount'=>$request['repNo']]);
    }

    public function getLessonVocabularyTranslate(Request $request)
    {
        $words = $this->getLessonWords($request['courseId'],$request['lessonId'], $request['repNo']);
        return view('vocabulary.translation', ['words' => $words, 'repetitions'=>null,'course_id' => $request['courseId'],'lesson_id' => $request['lessonId'],'excCount'=>$request['repNo']]);
    }

    public function getLessonGrammarTasks(Request $request)
    {
        $user_id = Auth::User()->id;
        $course_id = $request['courseId'];
        $lesson_id = $request['lessonId'];
        $tasks = Lesson::find($lesson_id)
            ->tasks
            ->filter(function($t) use($user_id,$course_id) {
            if(!$t->hasRepetition($user_id, $course_id )){ return $t; }
        })->values();
        return view('vocabulary.task', ['tasks' => $tasks, 'repetitions' => null, 'course_id' => $course_id, 'lesson_id' => $request['lessonId'], 'excCount'=>$request['repNo']]);
    }

    public function getLessonPDF($file_name)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= storage_path(). "/lessonspdfs/". $file_name;

        $headers = array(
                  'Content-Type: application/pdf',
                );

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function getLessons()
    {
        return Lesson::all();
    }
}