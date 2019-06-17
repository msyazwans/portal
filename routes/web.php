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

Route::get('/logout','Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['role:super']], function () {

    Route::get('/slider/list','SliderController@index');
    Route::get('/slider/new','SliderController@create');
    Route::post('/slider/new','SliderController@store');
    Route::get('/slider/{slider_id}/edit','SliderController@edit');
    Route::post('/slider/{slider_id}/edit','SliderController@update');
    Route::get('/slider/{slider_id}/destroy','SliderController@destroy');
    Route::get('/slider/{slider_id}/remove_photo','SliderController@remove_photo');

});










