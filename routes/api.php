<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/authenticate',[
    'uses' => 'UserController@authenticate'
]);



Route::group(['middleware' => ['auth:api']], function()
    {
        Route::get('/user',[
            'uses' => 'Api\ApiUserController@getUser'
        ]);

        Route::get('/user/{course_id}/repetitions',[
            'uses' => 'Api\ApiRepetitionController@getAuthUserRepetitions'
        ]);

        Route::get('/user/courses',[
            'uses' => 'Api\ApiCourseController@getAuthUserCourses'
        ]);

        Route::post('/updateRepetition', [
            'uses'=> 'RepetitionController@postUpdateRepetition',
        ]);
    });




