<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\PusherNotificationController;
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

Route::group(['prefix' => 'category'], function () {
    Route::get('', [
        'uses' => 'App\Http\Controllers\CategoryController@index',
        'as' => 'category.index'
    ]);

    Route::get('show/{id}',[
        'uses' => 'App\Http\Controllers\CategoryController@show',
        'as' => 'category.show'
    ]);

    Route::get('create',[
        'uses' => 'App\Http\Controllers\CategoryController@create',
        'as' => 'category.create'
    ]);

    Route::post('create',[
        'uses' => 'App\Http\Controllers\CategoryController@store',
        'as' => 'category.store'
    ]);

    Route::get('update/{id}',[
        'uses' => 'App\Http\Controllers\CategoryController@edit',
        'as' => 'category.edit'
    ]);

    Route::post('update/{id}',[
        'uses' => 'App\Http\Controllers\CategoryController@update',
        'as' => 'category.update'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'App\Http\Controllers\CategoryController@confirm',
        'as' => 'category.confirm'
    ]);

    Route::post('delete/{id}',[
        'uses' => 'App\Http\Controllers\CategoryController@destroy',
        'as' => 'category.destroy'
    ]);
});


use App\Events\formSubmit;

Route::get('/counter', function () {
    return view('counter');
});
Route::get('/sender', function () {
    return view('sender');
});
Route::post('/sender', function () {
    $comment1 = request()->comment1;
    $name = request()->name;
    event(new formSubmit($comment1, $name));
    return redirect('/sender');
});

Route::get('/notification', function () {
    return view('notification');
});
 
Route::get('send',[PusherNotificationController::class, 'notification']);

// gọi ra trang view demo-pusher.blade.php
Route::get('demo-pusher','FrontEndController@getPusher');
// Truyển message lên server Pusher
 Route::get('fire-event','FrontEndController@fireEvent');

