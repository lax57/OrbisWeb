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
/*Route::group(['middleware' => ['web']], function() {*/
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/user_courses', [
        'uses'=> 'CourseController@getUserCourses',
        'as' => 'user_courses',
        'middleware' => 'auth2'
    ]);

    Route::get('/course_page/{course_id}', [
        'uses'=> 'CourseController@getCoursePage',
        'as' => 'course_page',
        'middleware' => 'auth2'
    ]);

    Route::get('/course_page/{course_id}/lessons_overview', [
        'uses'=> 'CourseController@getLessons',
        'as' => 'lessons_overview',
        'middleware' => 'auth2'
    ]);

    Route::get('/course_page/{course_id}/lesson/{lesson_id}/vocabulary_intro', [
        'uses'=> 'LessonController@getLessonVocabulary',
        'as' => 'vocabulary_intro',
        'middleware' => 'auth2'
    ]);

    Route::get('/course_page/{course_id}/lesson/{lesson_id}/vocabulary_listen', [
        'uses'=> 'CourseController@getVocabularyListen',
        'as' => 'vocabulary_listen',
        'middleware' => 'auth2'
    ]);

    Route::get('/course_page/{course_id}/lesson/{lesson_id}/vocabulary_translation', [
        'uses'=> 'CourseController@getVocabularyTranslation',
        'as' => 'vocabulary_translation',
        'middleware' => 'auth2'
    ]);

    Route::get('/all_courses', [
        'uses'=> 'CourseController@getAllCourses',
        'as' => 'all_courses',
        'middleware' => 'auth2'
    ]);


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

    Route::post('/course_signup', [
        'uses' =>'CourseController@postCourseSignUp',
        'as' =>'course_signup',
        'auth' => 'auth2',
    ]);

    Route::post('/course_signout', [
        'uses' =>'CourseController@postCourseSignOut',
        'as' =>'course_signout',
        'auth' => 'auth2',
    ]);
//});