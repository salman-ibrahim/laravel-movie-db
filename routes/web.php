<?php

use Illuminate\Support\Facades\Route;

Route::get('/','App\Http\Controllers\MoviesController@index')->httpsOnly()->name('movies.index');
Route::get('/movie/{id}','App\Http\Controllers\MoviesController@show')->httpsOnly()->name('movies.show');

Route::get('/tv','App\Http\Controllers\TvController@index')->httpsOnly()->name('tv.index');
Route::get('/tv/{id}','App\Http\Controllers\TvController@show')->httpsOnly()->name('tv.show');

Route::get('/actors','App\Http\Controllers\ActorsController@index')->httpsOnly()->name('actors.index');
Route::get('/actors/page/{page?}','App\Http\Controllers\ActorsController@index')->httpsOnly();
Route::get('/actor/{id}','App\Http\Controllers\ActorsController@show')->httpsOnly()->name('actors.show');
