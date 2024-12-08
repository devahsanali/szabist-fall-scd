<?php

use App\Http\Controllers\Api\TeacherApiController;
use Illuminate\Support\Facades\Route;

Route::name('teacher.')->prefix('teacher')->group(function() {
    Route::get('/', [TeacherApiController::class, 'index'])->name('index');
    Route::get('create', [TeacherApiController::class, 'create'])->name('create');
    Route::post('store', [TeacherApiController::class, 'store'])->name('store');
    Route::get('edit/{id}', [TeacherApiController::class, 'edit'])->name('edit');
    Route::post('update', [TeacherApiController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [TeacherApiController::class, 'destroy'])->name('destroy');
});
