<?php

use Illuminate\Support\Facades\Route;

// Публичные страницы
Route::view('/', 'welcome');
Route::view('/main', 'site.main')->name('main');
Route::view('/decoration', 'site.decoration')->name('decoration');
Route::view('/delivery', 'site.delivery')->name('delivery');
Route::view('/masterclass', 'site.masterclass')->name('masterclass');
Route::view('/catalog', 'site.catalog')->name('catalog');

Route::view('/profile', 'site.profile')->name('profile');

// Аутентификация
Route::get('/auth', fn() => view('site.auth'))->name('auth');
Route::post('/auth', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', fn() => view('site.register'))->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit')->middleware('throttle:5,1'); // 5 регистраций в 1 минуту
