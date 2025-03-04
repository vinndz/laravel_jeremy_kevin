<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataRSController;
use App\Http\Controllers\DataPasienController;


Route::get('/', [LoginController::class, 'index'])->name('index');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Data RS
Route::prefix('data-rs')->name('data-rs.')->group(function (){
    Route::get('index', [DataRSController::class, 'index'])->name('index');
    Route::get('data', [DataRSController::class, 'data'])->name('data');
    Route::get('create', [DataRSController::class, 'create'])->name('create');
    Route::post('store', [DataRSController::class, 'store'])->name('store');
    Route::get('edit/{id}', [DataRSController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [DataRSController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [DataRSController::class, 'destroy'])->name('destroy');
});

// Data Pasien
Route::prefix('data-pasien')->name('data-pasien.')->group(function (){
    Route::get('index', [DataPasienController::class, 'index'])->name('index');
    Route::get('data', [DataPasienController::class, 'data'])->name('data');
    Route::get('create', [DataPasienController::class, 'create'])->name('create');
    Route::post('store', [DataPasienController::class, 'store'])->name('store');
    Route::get('edit/{id}', [DataPasienController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [DataPasienController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [DataPasienController::class, 'destroy'])->name('destroy');
});





