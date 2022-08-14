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
    // posyandu
    Route::get('/posyandu', 'list_posyandu')->name('list_posyandu');
    Route::get('/posyandu/tambah', 'tambah_posyandu')->name('tambah_posyandu');
    Route::post('/posyandu/tambah', 'tambah_posyandu_act')->name('tambah_posyandu_act');
    Route::get('/posyandu/update/{id}', 'update_posyandu')->name('update_posyandu');
    Route::post('/posyandu/update/{id}', 'update_posyandu_act')->name('update_posyandu_act');
    Route::post('/posyandu/delete/{id}', 'delete_posyandu')->name('delete_posyandu');

    // balita
    Route::get('/balita', 'list_balita')->name('list_balita');
    Route::get('/balita/tambah', 'tambah_balita')->name('tambah_balita');
    Route::post('/balita/tambah', 'tambah_balita_act')->name('tambah_balita_act');
    Route::get('/balita/update/{id}', 'update_balita')->name('update_balita');
    Route::post('/balita/update/{id}', 'update_balita_act')->name('update_balita_act');
    Route::post('/balita/delete/{id}', 'delete_balita')->name('delete_balita');
    
    // ibu_hamil
    Route::get('/ibu-hamil', 'list_ibu_hamil')->name('list_ibu_hamil');
    Route::get('/ibu-hamil/tambah', 'tambah_ibu_hamil')->name('tambah_ibu_hamil');
    Route::post('/ibu-hamil/tambah', 'tambah_ibu_hamil_act')->name('tambah_ibu_hamil_act');
    Route::get('/ibu-hamil/update/{id}', 'update_ibu_hamil')->name('update_ibu_hamil');
    Route::post('/ibu-hamil/update/{id}', 'update_ibu_hamil_act')->name('update_ibu_hamil_act');
    Route::post('/ibu-hamil/delete/{id}', 'delete_ibu_hamil')->name('delete_ibu_hamil');

    // lansia
    Route::get('/lansia', 'list_lansia')->name('list_lansia');
    Route::get('/lansia/tambah', 'tambah_lansia')->name('tambah_lansia');
    Route::post('/lansia/tambah', 'tambah_lansia_act')->name('tambah_lansia_act');
    Route::get('/lansia/update/{id}', 'update_lansia')->name('update_lansia');
    Route::post('/lansia/update/{id}', 'update_lansia_act')->name('update_lansia_act');
    Route::post('/lansia/delete/{id}', 'delete_lansia')->name('delete_lansia');

    // akun
    Route::get('/akun', 'list_akun')->name('list_akun');
    Route::get('/akun/tambah', 'tambah_akun')->name('tambah_akun');
    Route::post('/akun/tambah', 'tambah_akun_act')->name('tambah_akun_act');
    Route::get('/akun/update/{id}', 'update_akun')->name('update_akun');
    Route::post('/akun/update/{id}', 'update_akun_act')->name('update_akun_act');
    Route::post('/akun/delete/{id}', 'delete_akun')->name('delete_akun');
});


