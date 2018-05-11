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


Route::get('/', function() {
    return view('pusher');
});
Route::get('/test', function() {


});

Route::get('/notify',"HomeController@index");


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//后台
Route::get('admin/login', 'Admin\LoginController@index');
Route::namespace('Admin')->middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/','ArticalController@index')->name('admin_index');
});
