<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::post('login', [LoginController::class, 'store'])->name('authenticate.login');
Route::post('register', [RegistrationController::class, 'store'])->name('authenticate.register');
Route::post('password/forgot', [ForgotPasswordController::class, 'store'])->name('authenticate.forgot');
Route::patch('password/reset/{user}', [ForgotPasswordController::class, 'update'])->name('authenticate.reset')->middleware('signed');

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('logout', [LoginController::class, 'destroy'])->name('authenticate.logout');
});

Route::group(['prefix' => 'v1'], function () {
    //
});
