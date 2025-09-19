<?php

use Illuminate\Support\Facades\Route;
use \App\Livewire\Auth\AuthComponent;
use App\Livewire\Auth\RecoverPasswordComponent;

Route::get('/login', AuthComponent::class)->name('user.login');
Route::get('/recuperar/senha', RecoverPasswordComponent::class)->name('user.recover.password');