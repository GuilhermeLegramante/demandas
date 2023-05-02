<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@dashboard')->name('dashboard');

Route::get('/login', 'AuthController@loginView')->name('loginView');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/sair', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('/usuario')->group(function () {
        Route::get('/', 'UserController@table')->name('user.table');
        Route::get('/inclusao', 'UserController@form')->name('user.create');
        Route::get('/{id}', 'UserController@form')->name('user.edit');
    });

    Route::prefix('/cliente')->group(function () {
        Route::get('/', 'ClientController@table')->name('client.table');
        Route::get('/inclusao', 'ClientController@form')->name('client.create');
        Route::get('/{id}', 'ClientController@form')->name('client.edit');
    });
});
