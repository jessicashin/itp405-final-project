<?php

use App\User;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/search');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/search', 'StudentController@search');
    Route::get('/students/{id}', 'StudentController@show');
    Route::get('/register', 'StudentController@create');
    Route::post('/register', 'StudentController@store');

    Route::get('/students/{id}/enrollment', 'EnrollmentController@show');
    Route::get('/students/{id}/billing', 'BillingController@show');

    Route::get('/admin/users', 'UserController@show');
    Route::post('/admin/users', 'UserController@store');
    Route::put('/admin/users/{id}', 'UserController@update');
    Route::delete('/admin/users/{id}', 'UserController@destroy');

    Route::get('/instructors', 'InstructorController@show');
    Route::get('/admin/instructors', 'InstructorController@adminShow');
    Route::post('/admin/instructors', 'InstructorController@store');
    Route::put('/admin/instructors/{id}', 'InstructorController@update');
    Route::delete('/admin/instructors/{id}', 'InstructorController@destroy');

    Route::get('/courses', 'CourseController@search');
    Route::get('/courses/{id}', 'CourseController@show');
    Route::post('/courses/{id}', 'CourseController@enroll');
    Route::get('/admin/courses', 'CourseController@create');
    Route::post('/admin/courses', 'CourseController@store');

    // Authentication routes...
    Route::get('/login', 'Auth\AuthController@login');
    Route::post('/login', 'Auth\AuthController@authenticate');
    Route::get('/logout', 'Auth\AuthController@logout');
});
