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


use App\Mail\OsInfoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;
Route::post('post/accept/{post}','PostController@accept')->name('post.accept');
Route::post('post/like/{post}','PostController@likePost')->name('post.like');
Route::post('post/dislike/{post}','PostController@dislikePost')->name('post.dislike');
Route::resource('post','PostController');

Route::get('/', function (Request $request) {
//    $agent=new Jenssegers\Agent\Agent();
//    Mail::to(auth()->user())
//        ->send(new OsInfoMail( $agent));

    return view('welcome');
})->middleware('sendNotification');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/user', 'UserController@index')->name('user');
Route::get('/chat/{user}', 'ChatController@index')->name('chat.index');
Route::post('/chat/{user}', 'ChatController@newChat')->name('chat.new');

Route::post('/post/{id}/comment', 'CommentController@store')->name('comment.store');





