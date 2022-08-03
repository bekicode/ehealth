<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KaderController;
use App\Http\Controllers\KadesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NormalUserController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'redirect'])->name('home');
Route::get('/test', [HomeController::class, 'test'])->name('test');

// Normal User
Route::prefix('user')->controller(NormalUserController::class)->middleware(['isNormalUser'])->name('user.')->group(function () {
    // Route::get('/test', 'test');
});

// Kader
Route::prefix('kader')->controller(KaderController::class)->middleware(['isKader'])->name('kader.')->group(function () {
    // Route::get('/test', 'test');
});

// kades
Route::prefix('kades')->controller(KadesController::class)->middleware(['isKades'])->name('kades.')->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

// Admin
Route::prefix('kades')->controller(KadesController::class)->middleware(['isKades'])->name('kades.')->group(function () {
    // Route::get('/test', 'test');
});


