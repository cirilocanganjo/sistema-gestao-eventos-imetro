<?php

use App\Livewire\Dashboard\DashboardComponent;
use App\Livewire\Dashboard\UserComponent;
use App\Livewire\Dashboard\MyProfileComponent;
use Illuminate\Support\Facades\Route;



Route::prefix("/dashboard")->group(function () {
    Route::get('/home', DashboardComponent::class)->name('dashboard.home');
    Route::get('/utilizadores', UserComponent::class)->name('dashboard.users');
    Route::get('.meu.perfil', MyProfileComponent::class)->name('dashboard.profile');
});
