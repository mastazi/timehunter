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


Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');

Route::middleware('auth:api')->post('logout', 'API\RegisterController@logout');
Route::middleware('auth:api')->get('/get-user', 'API\RegisterController@getUser');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/todolists/v1', 'namespace' => 'Api\TodoTasks\V1', 'as' => 'todolists.api.'], function () {
    Route::resource('projects', 'ProjectController', ['except' => ['create', 'edit']])->middleware('auth:api');;
    Route::resource('todos', 'TodosController', ['except' => ['create', 'edit']])->middleware('auth:api');;
    Route::resource('tasks', 'TasksController', ['except' => ['create', 'edit']])->middleware('auth:api');;
    Route::resource('timers', 'TimerController', ['except' => ['create', 'edit']])->middleware('auth:api');;
    Route::post('tasks/{taskId}/timers/{id}/start', 'TimerController@startTimer')->middleware('auth:api');;
    Route::post('tasks/{taskId}/start', 'TimerController@startTimerByTaskId')->middleware('auth:api');;
    Route::post('timers/{id}/stop', 'TimerController@stopTimer')->middleware('auth:api');;
    Route::get('runningtasktimer', 'TimerController@getRunningTimer')->middleware('auth:api');;
    Route::post('todos/{id}/done', 'TodosController@done')->middleware('auth:api');;
    Route::post('todos/{todoId}/start', 'TimerController@startTimerByTodoId')->middleware('auth:api');;
    Route::post('timers/{id}/stop', 'TimerController@stopTimer')->middleware('auth:api');;
});

