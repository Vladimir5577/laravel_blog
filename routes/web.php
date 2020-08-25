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

/*
Route::get('/', function () {
    return view('start_page');
});
*/


// start page
Route::get('/start_page', 'HomeController@start_page')->name('start_page');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// store information post
Route::post('/store', 'HomeController@store')->name('store');

// user page
Route::get('/user_profile/{id}', 'HomeController@user_profile')->name('user_profile');

// add comment
Route::post('/add_comment', 'HomeController@add_comment')->name('add_comment');

// rating
Route::post('/rate_user', 'HomeController@rate_user')->name('rate_user');

// upload user photo
Route::post('/upload_user_photo', 'HomeController@upload_user_photo')->name('upload_user_photo');

