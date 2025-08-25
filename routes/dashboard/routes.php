<?php

use App\Livewire\Dashboard\DashboardComponent;
use Illuminate\Support\Facades\Route;



Route::prefix("sgei")->group(function () {
    Route::get('/dashboard', DashboardComponent::class)->name('dashboard.home');
});
