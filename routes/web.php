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
});
