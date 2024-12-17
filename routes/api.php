<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Tenants\HRIS\EmployeeController;
use App\Http\Controllers\Tenants\HRIS\PositionController;
use App\Http\Controllers\Tenants\Common\AddressController;
use App\Http\Controllers\Tenants\HRIS\DepartmentController;
use App\Http\Controllers\Tenants\Accounting\AccountController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Tenants\Accounting\CustomerController;
use App\Http\Controllers\Tenants\HRIS\EmployeeSalaryController;
use App\Http\Controllers\Tenants\HRIS\EmployeeBenefitController;
use App\Http\Controllers\Tenants\HRIS\EmployeeSettingController;
use App\Http\Controllers\Tenants\Accounting\SubAccountController;
use App\Http\Controllers\Tenants\HRIS\EmployeePositionController;
use App\Http\Controllers\Tenants\HRIS\EmploymentBenefitController;
use App\Http\Controllers\Tenants\HRIS\EmployeeAttendanceController;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        //
    });
};

Route::middleware(['api', 'universal', InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class])->group(function () {
    Route::post('login', [LoginController::class, 'store'])->name('authenticate.login');
    Route::post('register', [RegistrationController::class, 'store'])->name('authenticate.register');
    Route::post('password/forgot', [ForgotPasswordController::class, 'store'])->name('authenticate.forgot');
    Route::patch('password/reset/{user}', [ForgotPasswordController::class, 'update'])->name('authenticate.reset')->middleware('signed');

    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('logout', [LoginController::class, 'destroy'])->name('authenticate.logout');

        // HRIS
        Route::prefix('hris')->group(function () {
            Route::apiResource('employees', EmployeeController::class);
            Route::apiResource('departments', DepartmentController::class);
            Route::apiResource('positions', PositionController::class);
            Route::apiResource('employment-benefits', EmploymentBenefitController::class)->parameter('employment-benefits', 'employmentBenefit');

            Route::prefix('employees/{employee}')->group(function () {
                Route::apiResource('positions', EmployeePositionController::class)->except(['update', 'destroy'])->names('employees.positions');
                Route::apiResource('attendances', EmployeeAttendanceController::class)->names('employees.attendances');
                Route::apiResource('benefits', EmployeeBenefitController::class)->except(['show', 'update'])->parameter('benefits', 'employeeBenefit')->names('employees.benefits');
                Route::apiResource('settings', EmployeeSettingController::class)->parameter('settings', 'employeeSetting')->names('employees.settings');
                Route::apiResource('salaries', EmployeeSalaryController::class)->names('employees.salaries');
            });
        });

        // Accounting
        Route::prefix('accg')->group(function () {
            Route::apiResource('customers', CustomerController::class);
            Route::apiResource('accounts', AccountController::class);
            Route::prefix('accounts/{account}')->group(function () {
                Route::apiResource('sub-accounts', SubAccountController::class)->parameter('sub-accounts', 'subAccount');
            });
        });

        // Common
        Route::prefix('common')->group(function () {
            Route::apiResource('{model}/{id}/addresses', AddressController::class);
        });
    });
});
