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

// route名'login'と'logout'が2つできてしまうので、後で別の実装方法にする
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::prefix('array_to_csv')->name('array_to_csv.')->group(function () {
    Route::get('/', 'ArrayToCsvController@index')->name('index');
    Route::post('/', 'ArrayToCsvController@convertAndDownload')->name('convert_and_download');
});



Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::get('/register', 'RegisterController@showRegistrationForm');
    Route::post('/register', 'RegisterController@register');
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});

Route::prefix('memo')->name('memo.')->middleware('auth')->group(function () {
    Route::get('/', 'MemoController@index')->name('index');
    // todo: メモの新規作成はmemo/storeじゃなくて、memoにpostメソッドでアクセスするurlに変更する。
    Route::post('/store', 'MemoController@store')->name('store');
    Route::get('/{id}/edit', 'MemoController@edit')->name('edit');
    Route::put('/{id}/update', 'MemoController@update')->name('update');
    Route::delete('/{id}/destroy', 'MemoController@destroy')->name('destroy');
});