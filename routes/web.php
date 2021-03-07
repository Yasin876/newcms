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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    Route::get('trashed', 'PostController@get_trashed');
    Route::put('restore/{id}', 'PostController@restore')->name('posts.restore');
});

Route::middleware(['auth','admin'])->group(function(){ //user must be auth then admin
    Route::get('users','UserController@index')->name('users.index');
    Route::put('users/{id}','UserController@update')->name('users.update');
});

Route::get('test', 'CategoryController@get_data');
Route::get('testpost', 'PostController@get_data');

