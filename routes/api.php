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

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([''], function () {
   Route::resource('lecturers', LecturerController::class);
   Route::resource('students', StudentController::class);
   Route::resource('courses', CourseController::class);
   Route::resource('todos', TodoController::class);

   Route::put('courses/{course}/students/{student}', 'CourseController@addStudent');
   Route::delete('courses/{course}/students/{student}', 'CourseController@removeStudent');
   Route::put('courses/{course}/lecturers/{lecturer}', 'CourseController@addLecturer');
   Route::delete('courses/{course}/lecturers/{lecturer}', 'CourseController@removeLecturer');
});