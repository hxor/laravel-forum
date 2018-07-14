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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/forum', 'ForumController@index')->name('forum.index');
Route::get('/forum/channel/{slug}', ['uses' => 'ForumController@channel', 'as' => 'forum.channel']);

Route::get('{provider}/auth', 'SocialController@auth')->name('social.auth');
Route::get('{provider}/redirect', 'SocialController@authRedirect')->name('social.callback');

Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('channel', 'ChannelController');
    });

    Route::get('discussion/create', ['uses' => 'DiscussionController@create', 'as' => 'discussion.create']);
    Route::post('discussion', ['uses' => 'DiscussionController@store', 'as' => 'discussion.store']);
    Route::get('/discussion/{slug}', ['uses' => 'DiscussionController@show', 'as' => 'discussion.show']);
    Route::post('/discussion/{id}/reply', ['uses' => 'DiscussionController@reply', 'as' => 'discussion.reply']);

    Route::get('/discussion/{id}/watch', ['uses' => 'WatcherController@watch', 'as' => 'discussion.watch']);
    Route::get('/discussion/{id}/unwatch', ['uses' => 'WatcherController@unwatch', 'as' => 'discussion.unwatch']);

    Route::get('/reply/{id}/like', ['uses' => 'ReplyController@like', 'as' => 'reply.like']);
    Route::get('/reply/{id}/unlike', ['uses' => 'ReplyController@unlike', 'as' => 'reply.unlike']);
    Route::get('/reply/{id}/answered', ['uses' => 'ReplyController@bestAnswer', 'as' => 'reply.answered']);
});