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

Route::get('/sign-in', 'UserController@index');
Route::get('/', 'UserController@home');

Route::post('/sign-in', 'UserController@login');
Route::post('/sign-out', 'UserController@destroy');

Route::resource('/master/anggota', 'AnggotaController');
