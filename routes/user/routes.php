<?php

use App\Livewire\User\FormUserComponent;
use \Illuminate\Support\Facades\Route;

Route::prefix('/utilizador')->group(function () {
Route::get('/cadastrar/nova/conta/inicio', FormUserComponent::class)->name('user.store.account');
});
