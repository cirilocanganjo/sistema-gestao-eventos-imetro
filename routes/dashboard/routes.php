<?php

use App\Livewire\Dashboard\DashboardComponent;
use Illuminate\Support\Facades\Route;



Route::prefix("/dashboard")->group(function () {
    Route::get('/inicio', DashboardComponent::class)->name('dashboard.home');
});
