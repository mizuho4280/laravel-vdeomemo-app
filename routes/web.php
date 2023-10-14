<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;

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

Route::get('/', [ContentController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('contents', ContentController::class)->middleware('auth');

Route::resource('tags', TagController::class)->only(['store', 'update', 'destroy'])->middleware('auth');


Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('index');

//確認ページ
Route::post('/contact/confirm', 'App\Http\Controllers\ContactController@confirm')->name('confirm');

//送信完了ページ
Route::post('/contact/thanks', 'App\Http\Controllers\ContactController@send')->name('send');

Route::get('/like/{contentId}', [LikeController::class, 'store']);
Route::get('/unlike/{contentId}', [LikeController::class, 'destroy']);
Route::post('/like/{contentId}', [LikeController::class, 'store'])->name('like.store');
Route::post('/unlike/{contentId}', [LikeController::class, 'destroy'])->name('like.destroy');