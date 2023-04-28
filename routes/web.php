<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@dashboard')->name('dashboard');

Route::get('/calendario', 'MainController@calendar')->name('calendar');


Route::group(['middleware' => ['auth']], function () {
});
