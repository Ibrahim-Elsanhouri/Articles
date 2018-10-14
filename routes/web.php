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

Route::get('/contact','PagesController@contactus')->name('contact');
Route::post('/contact','PagesController@dosend')->name('contactsend');

Route::get('/about','PagesController@about')->name('about');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('posts','PostsController');
Route::resource('tags','TagsController');

Route::post('/posts/{post}', 'CommentsController@store')->name('posts.comments');
Route::post('/tags/{tag}', 'CommentsController@store')->name('tags.comments');


Route::get('/comments' , 'CommentsController@index');
Route::get('/comments/{id}' , 'CommentsController@edit')->name('comments.edit');

Route::delete('/comments/{id}' , 'CommentsController@destroy')->name('comments.destroy');
Route::put('/comments/{id}' , 'CommentsController@update')->name('comments.update');

Route::get('/user/verify/{token}' , 'Auth\RegisterController@verifyEmail')->name('user.verify');
