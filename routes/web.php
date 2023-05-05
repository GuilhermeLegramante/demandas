<?php

use Illuminate\Support\Facades\Route;


Route::get('/login', 'AuthController@loginView')->name('loginView');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/sair', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/', 'MainController@dashboard')->name('dashboard');

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

    Route::prefix('/status')->group(function () {
        Route::get('/', 'StatusController@table')->name('status.table');
        Route::get('/inclusao', 'StatusController@form')->name('status.create');
        Route::get('/{id}', 'StatusController@form')->name('status.edit');
    });

    Route::prefix('/tipo-de-demanda')->group(function () {
        Route::get('/', 'DemandTypeController@table')->name('demand-type.table');
        Route::get('/inclusao', 'DemandTypeController@form')->name('demand-type.create');
        Route::get('/{id}', 'DemandTypeController@form')->name('demand-type.edit');
    });

    Route::prefix('/demanda')->group(function () {
        Route::get('/', 'DemandController@table')->name('demand.table');
    });
});
