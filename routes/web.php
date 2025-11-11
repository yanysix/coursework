<?php

use Illuminate\Support\Facades\Route;

// Публичные страницы
Route::view('/', 'welcome');
Route::view('/main', 'site.main')->name('main');
Route::view('/decoration', 'site.decoration')->name('decoration');
Route::view('/delivery', 'site.delivery')->name('delivery');
Route::view('/masterclass', 'site.masterclass')->name('masterclass');
Route::view('/catalog', 'site.catalog')->name('catalog');
