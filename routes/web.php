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
Auth::routes();

Route::get('/', function () {
    return redirect('/rooms');
});

Route::resource('rooms','RoomController');
Route::get('rooms/check/{room}','RoomController@check')->name('rooms.check');
Route::put('rooms/check/{room}','RoomController@checkEdit')->name('rooms.checkEdit');
Route::post('rooms/edit','RoomController@information')->name('rooms.information');
//Route::put('rooms/check/{id}','RoomController@checkEdit')->name('rooms.checkEdit');

Route::get('/home', 'HomeController@index')->name('home');
