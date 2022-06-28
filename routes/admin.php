<?php


use Illuminate\Support\Facades\Route;

Route::prefix('/')
    ->namespace('Auth')
    ->name('auth.')->group(function () {

        Route::get('/backend/login', 'LoginController@indexAdmin')
            ->middleware('guest')
            ->name('backend.login');

        Route::post('/backend/login', 'LoginController@loginAdmin')
            ->middleware('guest')
            ->name('backend.login');

        Route::post('/backend/logout', 'LoginController@logoutAdmin')
            ->name('backend.logout');
    });
