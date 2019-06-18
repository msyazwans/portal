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

    Route::get('/service/list','ServiceController@index');
    Route::get('/service/new','ServiceController@create');
    Route::post('/service/new','ServiceController@store');
    Route::get('/service/{service_id}/edit','ServiceController@edit');
    Route::post('/service/{service_id}/edit','ServiceController@update');
    Route::get('/service/{service_id}/destroy','ServiceController@destroy');
    Route::get('/service/{service_id}/remove_photo','ServiceController@remove_photo');

    Route::get('/link/list','LinkController@index');
    Route::get('/link/new','LinkController@create');
    Route::post('/link/new','LinkController@store');
    Route::get('/link/{link_id}/edit','LinkController@edit');
    Route::post('/link/{link_id}/edit','LinkController@update');
    Route::get('/link/{link_id}/destroy','LinkController@destroy');
    Route::get('/link/{link_id}/remove_photo','LinkController@remove_photo');

    Route::get('/question/list','QuestionController@index');
    Route::get('/question/new','QuestionController@create');
    Route::post('/question/new','QuestionController@store');
    Route::get('/question/{question_id}/edit','QuestionController@edit');
    Route::post('/question/{question_id}/edit','QuestionController@update');
    Route::get('/question/{question_id}/destroy','QuestionController@destroy');
    Route::get('/question/{question_id}/remove_photo','QuestionController@remove_photo');

    Route::get('/contact/list','ContactController@index');
    Route::get('/contact/new','ContactController@create');
    Route::post('/contact/new','ContactController@store');
    Route::get('/contact/{contact_id}/edit','ContactController@edit');
    Route::post('/contact/{contact_id}/edit','ContactController@update');
    Route::get('/contact/{contact_id}/destroy','ContactController@destroy');
    Route::get('/contact/{contact_id}/remove_photo','ContactController@remove_photo');

});










