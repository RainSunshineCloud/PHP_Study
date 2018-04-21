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

Route::get('articles', 'ArticleController@index');
Route::get('articles/{id}', 'ArticleController@show');
Route::post('articles', 'ArticleController@store');
Route::put('articles/{id}', 'ArticleController@update');
Route::delete('articles/{id}', 'ArticleController@delete');
<<<<<<< HEAD
Route::get('/login',function (){

	return view('login');
=======
Route::group([
    'prefix'=>'/v1',
    'middleware' => ['api']
], function () {
    Route::post('/user/login','Api\LoginController@login');
>>>>>>> 3b0834e642561a8bd69a508db0283c5da8309ea8
});