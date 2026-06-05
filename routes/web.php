<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerformanceReportController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    Route::resource('accounts', AccountController::class)->except(['show', 'destroy']);
    Route::patch('accounts/{account}/toggle', [AccountController::class, 'toggle'])->name('accounts.toggle');

    Route::resource('examinations', ExaminationController::class)->only(['index', 'show']);
    Route::resource('results', ResultController::class)->only(['index', 'show']);

    Route::middleware('role:admin,instructor')->group(function () {
        Route::resource('examinations', ExaminationController::class)->except(['index', 'show']);
        Route::resource('questions', QuestionController::class)->except(['show']);
        Route::resource('results', ResultController::class)->except(['index', 'show']);
        Route::get('reports/performance', [PerformanceReportController::class, 'index'])->name('reports.performance');
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('instructors', InstructorController::class);
        Route::resource('subjects', SubjectController::class)->except(['show']);
    });
});
