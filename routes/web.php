<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\PackagingController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FlowerCartController;


/*
|--------------------------------------------------------------------------
| Публичные страницы
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome');
Route::view('/main', 'site.main')->name('main');
Route::view('/decoration', 'site.decoration')->name('decoration');
Route::view('/packaging', 'site.packaging')->name('packaging');
Route::view('/masterclass', 'site.masterclass')->name('masterclass');
Route::view('/flower', 'site.flower')->name('flower');

/*
|--------------------------------------------------------------------------
| Профиль пользователя
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::view('/profile', 'site.profile')->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.edit.password');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
});

/*
|--------------------------------------------------------------------------
| Регистрация и авторизация
|--------------------------------------------------------------------------
*/
Route::get('/register', fn() => view('site.register'))->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/auth', fn() => view('site.auth'))->name('auth')->middleware('guest');

Route::post('/auth', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Админ-панель
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [FlowerController::class, 'admin'])->name('flowers.admin');
    // CRUD для цветов
    Route::resource('flowers', FlowerController::class);

    Route::get('/packagings', [PackagingController::class, 'admin'])->name('packaging.admin');
    // CRUD для упаковки
    Route::resource('packaging', PackagingController::class);
});

// Маршрут для кастомной обертки
Route::post('/admin/packaging/custom', [PackagingController::class, 'storeCustom'])->name('packaging.custom');

Route::get('/cards', function () {
    return view('site.cards'); // путь к шаблону, который мы создали
})->name('cards');

Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
Route::post('/cards/create-pdf', [CardController::class, 'createPdf'])->name('cards.createPdf');
Route::get('/cards/download/{token}', [CardController::class, 'download'])->name('cards.download');


Route::get('/flower', [FlowerController::class, 'index'])->name('flower');
Route::get('/packaging', [PackagingController::class, 'index'])->name('packaging');


Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/flower/add', [CartController::class, 'addFlower'])->name('cart.flower.add');
    Route::post('/packaging/add', [CartController::class, 'addPackaging'])->name('cart.packaging.add');
    Route::delete('/remove/{type}/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
});

