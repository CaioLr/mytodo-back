<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Auth
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});

//Users
Route::group([

    'middleware' => 'jwt.auth',
    'prefix' => 'user'

], function () {
    Route::get('all','App\Http\Controllers\UserController@findAll');
    Route::get('find','App\Http\Controllers\UserController@findOne');
    Route::post('store','App\Http\Controllers\UserController@store')->withoutMiddleware('jwt.auth');;
    Route::put('edit','App\Http\Controllers\UserController@update');
    Route::delete('delete','App\Http\Controllers\UserController@delete');

});

//Boards
Route::group([

    'middleware' => ['jwt.auth'],
    'prefix' => 'board'

], function () {
    Route::get('all','App\Http\Controllers\BoardController@findAll');
    Route::get('find','App\Http\Controllers\BoardController@findOne');
    Route::post('store','App\Http\Controllers\BoardController@store');
    Route::put('edit','App\Http\Controllers\BoardController@update');
    Route::delete('delete','App\Http\Controllers\BoardController@delete');

});

//Tasks
Route::group([

    'middleware' => ['jwt.auth'],
    'prefix' => 'task'

], function () {
    Route::get('all','App\Http\Controllers\TaskController@findAll');
    Route::get('find','App\Http\Controllers\TaskController@findOne');
    Route::post('store','App\Http\Controllers\TaskController@store');
    Route::put('edit','App\Http\Controllers\TaskController@update');
    Route::delete('delete','App\Http\Controllers\TaskController@delete');

});


