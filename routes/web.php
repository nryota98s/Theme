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
Route::get('/main', 'PostsController@index')->middleware('auth');
// 投稿ページの表示
Route::get('/create-form', 'PostsController@createForm')->middleware('auth');
// 投稿ページの表示
Route::post('/post/create', 'PostsController@create')->middleware('auth');
// 投稿の編集ページ
Route::get('post/{id}/update-form', 'PostsController@updateForm')->middleware('auth');
// 投稿の編集
Route::post('/post/update', 'PostsController@update')->middleware('auth');
// 投稿の削除
Route::get('/post/{id}/delete', 'PostsController@delete')->middleware('auth');
// プロフィールの編集のページ　ミドルウェアの入力
Route::get('{userId}/prof-update', 'PostsController@profileupdateForm')->middleware('auth')->middleware('userid');
// プロフィールの編集
Route::post('/profile/update', 'PostsController@profileupdate')->middleware('auth');
// プロフィールのページ
Route::get('{userId}/profile', 'PostsController@profile')->middleware('auth');
// プロフィールのフォロー中のユーザー一覧ページ
Route::get('{userId}/profile/following', 'PostsController@following')->middleware('auth');
// プロフィールのフォロワー一覧ページ
Route::get('{userId}/profile/followed', 'PostsController@followed')->middleware('auth');
// 検索結果表示
Route::post('/search-form', 'PostsController@search')->middleware('auth');
// フォロー追加
Route::get('/follow/{id}', 'PostsController@follow')->middleware('auth');
// フォロー削除機能
Route::get('/follow/{id}/delete', 'PostsController@unfollow');
// 管理者
Route::get('/admin', 'AdminController@index')->middleware('admin');
