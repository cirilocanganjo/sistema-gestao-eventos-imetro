<?php

use Illuminate\Support\Facades\Route;
use \App\Livewire\Home\HomeComponent;

Route::get('/test', function () {
return md5('user-female');
});
Route::get('/', HomeComponent::class)->name('evently.app.home');
Route::prefix('sistena.gestao.eventos.imetro')->group(function () {

});
