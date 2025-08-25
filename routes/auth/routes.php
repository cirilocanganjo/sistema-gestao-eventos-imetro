<?php
use Illuminate\Support\Facades\Route;

Route::prefix("sgei")->group(function () {
    Route::get('/login', \App\Livewire\Login\LoginComponent::class)->name('login');
});