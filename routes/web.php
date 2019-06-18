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

    Route::get('/announcement/list','AnnouncementController@index');
    Route::get('/announcement/new','AnnouncementController@create');
    Route::post('/announcement/new','AnnouncementController@store');
    Route::get('/announcement/{announcement_id}/edit','AnnouncementController@edit');
    Route::post('/announcement/{announcement_id}/edit','AnnouncementController@update');
    Route::get('/announcement/{announcement_id}/destroy','AnnouncementController@destroy');
    Route::get('/announcement/{announcement_id}/remove_photo','AnnouncementController@remove_photo');

    Route::get('/article/list','ArticleController@index');
    Route::get('/article/new','ArticleController@create');
    Route::post('/article/new','ArticleController@store');
    Route::get('/article/{article_id}/edit','ArticleController@edit');
    Route::post('/article/{article_id}/edit','ArticleController@update');
    Route::get('/article/{article_id}/destroy','ArticleController@destroy');
    Route::get('/article/{article_id}/remove_photo','ArticleController@remove_photo');

});










