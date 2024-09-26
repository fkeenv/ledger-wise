<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Tenants\EmployeeController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Tenants\DepartmentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        //
    });
};

Route::middleware(['api', InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class])->group(function () {
    Route::post('login', [LoginController::class, 'store'])->name('authenticate.login');
    Route::post('register', [RegistrationController::class, 'store'])->name('authenticate.register');
    Route::post('password/forgot', [ForgotPasswordController::class, 'store'])->name('authenticate.forgot');
    Route::patch('password/reset/{user}', [ForgotPasswordController::class, 'update'])->name('authenticate.reset')->middleware('signed');

    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('logout', [LoginController::class, 'destroy'])->name('authenticate.logout');

        Route::prefix('hris')->group(function () {
            Route::apiResources([
                'employees' => EmployeeController::class,
                'departments' => DepartmentController::class,
            ]);
        });
    });
});
