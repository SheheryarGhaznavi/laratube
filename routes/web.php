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

Auth::routes();


Route::get('video/{video}/comment','CommentController@index');
Route::get('comment/{comment}/reply','CommentController@getReply');
Route::get('vote/{video}/{type}','VoteController@toggle');
Route::put('video/{video}/view','VideoController@view');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('channel','ChannelController');
Route::resource('video','VideoController');
Route::resource('channel/{channel}/subscription','SubscriptionController');
Route::resource('channel/{channel}/upload/video','UploadVideoController');
