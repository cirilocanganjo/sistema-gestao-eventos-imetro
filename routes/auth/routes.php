<?php

use \App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->controller(AuthController::class)->group(function () {  
    Route::post('/login', 'login')->name('api.login');
});