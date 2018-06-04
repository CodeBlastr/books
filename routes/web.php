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

Route::get('/', function () {
    return view('welcome');
});

// this is for testing  (I expect to comment these routes out)
//Route::get('/accounts',  'AccountController@index');
Route::post('/credentials/store', 'CredentialController@store');
Route::get('/accounts/create', 'AccountController@create');

Route::get('/home', 'HomeController@index')->name('home');

// this is for production
//Route::any('/{all}', function ($all) {
//    return view('welcome');
//})->where(['all' => '.*']);