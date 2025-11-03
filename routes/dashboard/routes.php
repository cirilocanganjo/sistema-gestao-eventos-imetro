<?php

use App\Livewire\Dashboard\AccessLevelComponent;
use App\Livewire\Dashboard\DashboardComponent;
use App\Livewire\Dashboard\EventComponent;
use App\Livewire\Dashboard\InvitationComponent;
use App\Livewire\Dashboard\UserComponent;
use App\Livewire\Dashboard\MyProfileComponent;
use App\Livewire\Dashboard\TeacherComponent;
use App\Livewire\Dashboard\VisitorComponent;
use \App\Http\Middleware\Admin\Middleware as admin;
use App\Livewire\Dashboard\CategoryComponent;
use Illuminate\Support\Facades\Route;



Route::prefix("dashboard")->middleware([admin::class])->group(function () {
Route::get('/home', DashboardComponent::class)->name('dashboard.home');
Route::get('/utilizadores', UserComponent::class)->name('dashboard.users');
Route::get('/perfil', MyProfileComponent::class)->name('dashboard.profile');
Route::get('/niveis-de-acesso', AccessLevelComponent::class)->name('dashboard.access.levels');
Route::get('/eventos',EventComponent::class)->name('dashboard.events');
Route::get('/categorias',CategoryComponent::class)->name('dashboard.categories');
Route::get('/convites',InvitationComponent::class)->name('dashboard.invitations');
Route::get('/docentes',TeacherComponent::class)->name('dashboard.teachers');
Route::get('/visitantes',VisitorComponent::class)->name('dashboard.visitors');
});

