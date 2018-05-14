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
    //return date("Y-m-d H:i:s");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/wordlist', 'WordlistController@index')->name('wordlist');
Route::get('/wordlist/card','WordlistController@card'); //要放在‘/wordlist/{id}’前面
Route::get('/wordlist/test','WordlistController@test');
Route::get('/wordlist/search','WordlistController@search');
Route::get('/wordlist/{id}','WordlistController@show');
Route::get('/wordlist/list/{id}','WordlistController@list');
Route::get('/wordlist/olist/{initial}/','WordlistController@olist');
Route::get('/wordlist/familiar/{id}','WordlistController@familiar');

//Route::get('/translate', 'TranslateController@index')->name('translate');



//Admin
Route::group(['middleware'=>'auth','namespace'=>'Admin','prefix'=> 'admin'],
  function(){
    Route::get('/', 'HomeController@index');
    //Route::get('wordlist', 'WordlistController@index');
    Route::resource('wordlists', 'WordlistController');
});
