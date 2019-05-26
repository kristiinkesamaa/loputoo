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


Route::get('/competitions/{id}/subgroups/{subgroup_id}', 'Pages@show_subgroup');


Route::resource('competitions', "Competitions");

Route::post('/competitions/{id}/queue', "Pages@queue");


Route::get('/competitions/{id}/{league}/{type}', "Groups@show");

Route::get('/competitions/{id}/{league}/{type}/{team_id}/edit', "Groups@edit");

Route::patch('/competitions/{id}/{league}/{type}/{team_id}', "Groups@update");

Route::delete('/competitions/{id}/{league}/{type}/{team_id}', "Groups@destroy");


Route::post('/competitions/{id}/{league}/{type}/subgroup', "Pages@add_subgroup");


Route::post('/competitions/{id}/register', 'Registration@register');

Route::patch('/competitions/{id}/confirm', 'Registration@confirm');

Route::patch('/competitions/{id}/destroy', 'Registration@destroy');


Auth::routes();

Route::get('/logout', 'Pages@logout');
