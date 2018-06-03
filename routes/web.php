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
//Route::get('/{any}', function ($any) {
//
//    // any other url, subfolders also
//
//})->where('any', '.*');
Route::get('/', function () {
    return view('welcome');
});

// this is for testing  (I expect to comment these routes out)
//Route::get('/accounts',  'AccountController@index');
Route::get('/credentials/store', 'CredentialController@store');

// this is for production
Route::any('/{all}', function ($all) {
    return view('welcome');
})->where(['all' => '.*']);