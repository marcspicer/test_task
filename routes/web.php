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

Auth::routes();

Route::get('/', 'UserController@showUsers')->name('home');
Route::get('profile/{name}', 'UserController@userProfile');
Route::post('/save','UserController@saveData');
Route::get('delete/{id}', 'UserController@deleteData');

Route::post('/saveImg', [
	'uses'	=>	'UserController@saveImage',
	'as'	=>	'saveImg'
]);

Route::post('/delImg', [
	'uses'	=>	'UserController@delImg',
	'as'	=>	'delImg'
]);