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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home')->middleware('verified');

Route::get('admin/routes', 'HomeController@admin')->middleware('admin');


// PROFILE

Route::get('profile/{username}', 'UsersController@index')->name('profile.info')->middleware('verified');

Route::post('/profile/{username}/update', 'UsersController@update')->name('profile.update');

// IMAGE CROP

Route::post('/upload', 'CropController@postUpload');
Route::post('/crop', 'CropController@postCrop');
