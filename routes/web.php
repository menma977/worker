<?php

use Illuminate\Support\Facades\Route;

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

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');

Route::get('/', static function () {
  if (Auth::guest()) {
    return redirect()->route('login');
  }

  return redirect()->route('home');
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
  Route::get('/', 'UserController@index')->name('index')->middleware('auth', 'role:1|2|3|4');
  Route::get('/create', 'UserController@create')->name('create')->middleware('auth', 'role:1|2|3|4');
  Route::post('/store', 'UserController@store')->name('store')->middleware('auth', 'role:1|2|3|4');
  Route::post('/edit', 'UserController@findAndChange')->name('findAndChange')->middleware('auth', 'role:1|2|3|4');
  Route::get('/edit/{id}', 'UserController@edit')->name('edit')->middleware('auth', 'role:1|2|3|4');
  Route::post('/update/{id}', 'UserController@update')->name('update')->middleware('auth', 'role:1|2|3|4');
  Route::get('/suspand/{id}', 'UserController@suspand')->name('suspand')->middleware('auth', 'role:1|2|3|4');
  Route::get('/delete/{id}', 'UserController@destroy')->name('delete')->middleware('auth', 'role:1|2|3|4');
});

Route::group(['prefix' => 'absent', 'as' => 'absent.'], function () {
  Route::get('/', 'AbsentController@index')->name('index')->middleware('auth', 'role:1|2|3|4');
  Route::post('/store', 'AbsentController@store')->name('store')->middleware('auth', 'role:1|2|3|4');
  Route::post('/show', 'AbsentController@show')->name('show')->middleware('auth', 'role:1|2|3|4');
  Route::post('/update/{id}', 'AbsentController@update')->name('update')->middleware('auth', 'role:1|2|3|4');
  Route::get('/delete', 'AbsentController@delete')->name('delete')->middleware('auth', 'role:1|2|3|4');
});

Route::group(['prefix' => 'salary', 'as' => 'salary.'], function () {
  Route::get('/', 'SalaryController@index')->name('index')->middleware('auth', 'role:1|2|3|4');
  Route::post('/store', 'SalaryController@store')->name('store')->middleware('auth', 'role:1|2|3|4');
  Route::post('/show', 'SalaryController@show')->name('show')->middleware('auth', 'role:1|2|3|4');
  Route::post('/update', 'SalaryController@update')->name('update')->middleware('auth', 'role:1|2|3|4');
  Route::get('/delete', 'SalaryController@delete')->name('delete')->middleware('auth', 'role:1|2|3|4');
});