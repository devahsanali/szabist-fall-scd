<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.web');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('student.')->prefix('student')->group(function() {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('create', [StudentController::class, 'create'])->name('create');
        Route::post('store', [StudentController::class, 'store'])->name('store');
        Route::get('edit/{id}', [StudentController::class, 'edit'])->name('edit');
        Route::post('update', [StudentController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [StudentController::class, 'destroy'])->name('destroy');
        Route::get('/search', [StudentController::class, 'search'])->name('search');
    });

    Route::name('enrollment.')->prefix('enrollment')->group(function() {
        Route::get('/', [EnrollmentController::class, 'index'])->name('index');
        Route::get('create', [EnrollmentController::class, 'create'])->name('create');
        Route::post('store', [EnrollmentController::class, 'store'])->name('store');
        Route::get('edit/{id}', [EnrollmentController::class, 'edit'])->name('edit');
        Route::post('update', [EnrollmentController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [EnrollmentController::class, 'destroy'])->name('destroy');
    });

    Route::name('course.')->prefix('course')->group(function() {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('create', [CourseController::class, 'create'])->name('create');
        Route::post('store', [CourseController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CourseController::class, 'edit'])->name('edit');
        Route::post('update', [CourseController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [CourseController::class, 'destroy'])->name('destroy');
    });

    Route::name('teacher.')->prefix('teacher')->group(function() {
        Route::get('/', [TeacherController::class, 'index'])->name('index');
        Route::get('create', [TeacherController::class, 'create'])->name('create');
        Route::post('store', [TeacherController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TeacherController::class, 'edit'])->name('edit');
        Route::post('update', [TeacherController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [TeacherController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
