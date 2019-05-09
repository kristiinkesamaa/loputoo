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

Route::get('/', "Pages@index");

Route::resource('competitions', "Competitions");

Route::post('/competitions/{id}/register', 'Registration@register');

Route::patch('/competitions/{id}/confirm', 'Registration@confirm');

Auth::routes();

Route::get('/logout', 'Pages@logout');
