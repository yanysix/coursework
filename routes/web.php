<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;

// Публичные страницы
Route::view('/', 'welcome');
Route::view('/main', 'site.main')->name('main');
Route::view('/decoration', 'site.decoration')->name('decoration');
Route::view('/delivery', 'site.delivery')->name('delivery');
Route::view('/masterclass', 'site.masterclass')->name('masterclass');
Route::view('/catalog', 'site.catalog')->name('catalog');
Route::view('/profile', 'site.profile')->name('profile');

// Регистрация
Route::get('/register', fn() => view('site.register'))->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Авторизация
Route::get('/auth', fn() => view('site.auth'))->name('auth');
Route::post('/auth', [AuthController::class, 'login'])->name('auth.login');

// Выход
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Личная информация
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Пароль
Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.edit.password');
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

Route::delete('/profile/delete', [ProfileController::class, 'delete'])
    ->name('profile.delete')
    ->middleware('auth');
Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar')->middleware('auth');


