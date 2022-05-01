<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout'])->name('logout');

Route::middleware(["auth"])->group(function () {
    Route::get('/', [App\Http\Controllers\VoucherController::class, 'index'])->name('vouchers');
    Route::get('/export', [App\Http\Controllers\VoucherController::class, 'export'])->name('export');
});

