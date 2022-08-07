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
Route::prefix('admin')->controller(AdminController::class)->middleware(['isAdmin'])->name('admin.')->group(function () {
    Route::get('/posyandu', 'list_posyandu')->name('list_posyandu');
    Route::get('/posyandu/tambah', 'tambah_posyandu')->name('tambah_posyandu');
    Route::post('/posyandu/tambah', 'tambah_posyandu_act')->name('tambah_posyandu_act');
    Route::get('/posyandu/update/{id}', 'update_posyandu')->name('update_posyandu');
    Route::post('/posyandu/update/{id}', 'update_posyandu_act')->name('update_posyandu_act');
    Route::get('/posyandu/delete/{id}', 'delete_posyandu')->name('delete_posyandu');
});


