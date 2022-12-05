<?php

use Illuminate\Support\Facades\Route;


Route::get('/','DashboardController@index');

Route::get('/forget-password-page', 'PasswordResetController@index');
Route::post('/forget-password', 'PasswordResetController@forgetpassword');
