<?php

use App\Http\Controllers\Api\TeacherApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Public route for login
Route::post('login', [AuthController::class, 'login']);

// Protected route
Route::middleware('auth:api')->group(function () {
    // Other protected routes can go here
    Route::get('/profile', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
        ]);
    });

    // Logout route (revoke the access token)
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::name('teacher.')->prefix('teacher')->group(function() {
        Route::get('/', [TeacherApiController::class, 'index'])->name('index');
        Route::get('create', [TeacherApiController::class, 'create'])->name('create');
        Route::post('store', [TeacherApiController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TeacherApiController::class, 'edit'])->name('edit');
        Route::put('update', [TeacherApiController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [TeacherApiController::class, 'destroy'])->name('destroy');
    });
});




