<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//Route::group(['middleware' => ['web']], function() {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');


    Route::group(['middleware' => ['auth2']], function() {

        Route::get('/user_courses', [
            'uses'=> 'CourseController@getUserCourses',
            'as' => 'user_courses',
        ]);

        Route::get('/course_page/{course_id}', [
            'uses'=> 'CourseController@getCoursePage',
            'as' => 'course_page',
        ]);

        Route::get('/course_page/{course_id}/lessons_overview', [
            'uses'=> 'CourseController@getLessons',
            'as' => 'lessons_overview',
        ]);

        Route::post('/vocabulary_intro', [
            'uses'=> 'LessonController@getLessonVocabularyIntro',
            'as' => 'vocabulary_intro',
        ]);

        Route::post('/course_page/word_repetitions', [
            'uses'=> 'RepetitionController@getWordRepetitions',
            'as' => 'word_repetition',
        ]);

        Route::post('/course_page/grammar_repetitions', [
            'uses'=> 'RepetitionController@getGrammarRepetitions',
            'as' => 'grammar_repetition',
        ]);

        Route::post('vocabulary_listen', [
            'uses'=> 'LessonController@getLessonVocabularyListen',
            'as' => 'vocabulary_listen',
        ]);

        Route::post('/grammar_task', [
            'uses'=> 'LessonController@getLessonGrammarTasks',
            'as' => 'grammar_task',
        ]);

        Route::post('/vocabulary_translation', [
            'uses'=> 'LessonController@getLessonVocabularyTranslate',
            'as' => 'vocabulary_translate',
        ]);

        Route::get('/all_courses', [
            'uses'=> 'CourseController@getAllCourses',
            'as' => 'all_courses',
        ]);

        Route::post('/fetchWordTranslation', [
            'uses'=> 'WordController@postFetchWordTranslation',
            'as' => 'fetchWordTranslation',
        ]);


        Route::post('/setRepetition/', [
            'uses'=> 'RepetitionController@postSetRepetition',
            'as' => 'setRepetition',
        ]);

        Route::post('/updateRepetition/', [
            'uses'=> 'RepetitionController@postUpdateRepetition',
            'as' => 'updateRepetition',
        ]);

        Route::post('/course_signup', [
            'uses' =>'CourseController@postCourseSignUp',
            'as' =>'course_signup',
        ]);

        Route::post('/course_signout', [
            'uses' =>'CourseController@postCourseSignOut',
            'as' =>'course_signout',
        ]);

        Route::get('/lesson_pdf/{file_name}', [
            'uses' => 'LessonController@getLessonPDF',
            'as'=>'lesson_pdf',
        ]);
    });

    Route::post('/signin', [
        'uses'=> 'UserController@postSignIn',
        'as' => 'signin'
    ]);

    Route::post('/signup', [
        'uses'=> 'UserController@postSignUp',
        'as' => 'signup'
    ]);

    Route::get('/logout', [
        'uses'=> 'UserController@getLogout',
        'as' => 'logout'
    ]);

    Route::group(['prefix' => 'api/v1'], function()
    {
        Route::resource('lessons','LessonController@getLessons');
    });