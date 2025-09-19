<?php

use App\Http\Controllers\Api\VisitorTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/api')->controller(VisitorTypeController::class)->group(function () {
Route::get('/visitor/types', 'show')->name('api.user.show.visitor.types');
});