<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::post('login', [LoginController::class, 'store'])->name('authenticate.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::patch('logout', [LoginController::class, 'destroy'])->name('authenticate.logout');
});

Route::group(['prefix' => 'v1'], function () {
    //
});
