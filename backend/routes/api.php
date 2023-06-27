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

//Users
Route::get('api/userAll','UserController@findAll');
Route::get('api/userFind','UserController@findOne');
Route::get('api/userStore','UserController@store');
Route::get('api/userUpdate','UserController@update');
Route::get('api/userDelete','UserController@delete');
//Boards
Route::get('api/boardAll','BoardController@findAll');
Route::get('api/boardFind','BoardController@findOne');
Route::get('api/boardStore','BoardController@store');
Route::get('api/boardUpdate','BoardController@update');
Route::get('api/boardDelete','BoardController@delete');
//Tasks
Route::get('api/taskAll','TaskController@findAll');
Route::get('api/taskFind','TaskController@findOne');
Route::get('api/taskStore','TaskController@store');
Route::get('api/taskUpdate','TaskController@update');
Route::get('api/taskDelete','TaskController@delete');
