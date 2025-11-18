<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\PackagingController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ZodiacController;


/*
|--------------------------------------------------------------------------
| Публичные страницы
|--------------------------------------------------------------------------
*/
Route::middleware('throttle:60,1')->group(function () {
    Route::view('/', 'welcome');
    Route::view('/main', 'site.main')->name('main');
    Route::view('/decoration', 'site.decoration')->name('decoration');
    Route::view('/masterclass', 'site.masterclass')->name('masterclass');
    Route::get('/flower', [FlowerController::class, 'index'])->name('flower');
    Route::get('/packaging', [PackagingController::class, 'index'])->name('packaging');
});

/*
|--------------------------------------------------------------------------
| Регистрация и авторизация
|--------------------------------------------------------------------------
*/
Route::middleware(['guest', 'throttle:10,1'])->group(function () {
    Route::get('/register', fn() => view('site.register'))->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    Route::get('/auth', fn() => view('site.auth'))->name('auth');
    Route::post('/auth', [AuthController::class, 'login'])->name('auth.login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Зодиак
|--------------------------------------------------------------------------
*/
Route::prefix('zodiac')->middleware('throttle:20,1')->group(function () {
    Route::get('/', [ZodiacController::class, 'index'])->name('zodiac.index');
    Route::post('/select', [ZodiacController::class, 'select'])->name('zodiac.select');
    Route::get('/result', [ZodiacController::class, 'result'])->name('zodiac.result');
});


/*
|--------------------------------------------------------------------------
| Профиль пользователя
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'throttle:30,1'])->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/delete', [ProfileController::class, 'delete'])->name('profile.delete');
});

/*
|--------------------------------------------------------------------------
| Корзина
|--------------------------------------------------------------------------
*/
Route::prefix('cart')->middleware(['auth', 'throttle:30,1'])->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/flower/add', [CartController::class, 'addFlower'])->name('cart.flower.add');
    Route::post('/packaging/add', [CartController::class, 'addPackaging'])->name('cart.packaging.add');
    Route::delete('/remove/{type}/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
});

/*
|--------------------------------------------------------------------------
| Открытки / PDF
|--------------------------------------------------------------------------
*/
Route::prefix('cards')->middleware(['auth', 'throttle:30,1'])->group(function () {
    Route::get('/', [CardController::class, 'index'])->name('cards.index');
    Route::post('/create-pdf', [CardController::class, 'createPdf'])->name('cards.createPdf');
    Route::get('/download/{token}', [CardController::class, 'download'])->name('cards.download');
});

/*
|--------------------------------------------------------------------------
| Админ-панель
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['admin', 'throttle:30,1'])->group(function () {
    Route::get('/flowers', [FlowerController::class, 'admin'])->name('flowers.admin');
    Route::resource('flowers', FlowerController::class);

    Route::get('/packagings', [PackagingController::class, 'admin'])->name('packaging.admin');
    Route::resource('packaging', PackagingController::class);

    Route::post('/packaging/custom', [PackagingController::class, 'storeCustom'])->name('packaging.custom');
});



