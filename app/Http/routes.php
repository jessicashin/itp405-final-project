<?php

use \App\Services\API\Flickr;

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
    return view('welcome');
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
});
