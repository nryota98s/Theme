<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');


});

Auth::routes();

Route::get('/main', 'HomeController@index')->name('main');

// 投稿一覧ページ
Route::get('/main', 'PostsController@index');
// 投稿ページの表示
Route::get('/create-form', 'PostsController@createForm');
// 投稿ページの表示
Route::post('/post/create', 'PostsController@create');
// 投稿の編集ページ
Route::get('post/{id}/update-form', 'PostsController@updateForm');

Route::post('/post/update', 'PostsController@update');
