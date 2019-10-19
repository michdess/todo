<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('todos', 'TodoController@index')->middleware('auth');
Route::post('todo', 'TodoController@store')->middleware('auth');
Route::patch('todo/{id}', 'TodoController@update')->middleware('auth');
Route::delete('todo/{id}', 'TodoController@destroy')->middleware('auth');
