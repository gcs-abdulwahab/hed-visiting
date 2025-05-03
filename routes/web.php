<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MonthlyBillingController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Employees\Form;
use App\Http\Livewire\Employees\Index;
use App\Http\Livewire\MonthlyBillings\Index as MonthlyBillingsIndex;

// Home route
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Settings & Profile
    Route::get('/settings/profile', [ProfileController::class, 'edit'])->name('settings.profile');
    Route::patch('/settings/profile', [ProfileController::class, 'update'])->name('settings.update');
    Route::delete('/settings/profile', [ProfileController::class, 'destroy'])->name('settings.destroy');

    // Employee Management (Admin & SuperAdmin only)
    Route::middleware(['role:admin,superadmin'])->group(function () {
        Route::get('/employees', Index::class)->name('employees.index');
        Route::get('/employees/create', Form::class)->name('employees.create');
        Route::get('/employees/{employee}/edit', Form::class)->name('employees.edit');

        Route::resource('departments', \App\Http\Controllers\DepartmentController::class);
        Route::get('/monthly-billings', MonthlyBillingsIndex::class)->name('monthly-billings.index');
    });

    // Teacher Routes
    Route::middleware(['role:teacher'])->group(function () {
        Route::get('teacher/records', [TeacherController::class, 'records'])->name('teacher.records');
        Route::post('teacher/records', [TeacherController::class, 'storeRecord'])->name('teacher.records.store');
    });
});

// API Routes
Route::prefix('api')->group(function () {
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });
});

require __DIR__ . '/auth.php';
