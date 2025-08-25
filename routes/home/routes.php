<?php

use Illuminate\Support\Facades\Route;
use \App\Livewire\Home\HomeComponent;



Route::get('/', HomeComponent::class)->name('home');
Route::prefix('sgei')->group(function () {

});