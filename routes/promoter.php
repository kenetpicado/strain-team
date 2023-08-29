<?php

namespace App\Http\Controllers\API\Promoter\V1;

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "v1"], function() {
    Route::post('register', RegisterPromoterController::class)->name('register');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::post('forgot-password', ForgotPasswordController::class)->name('forgot-password');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::resource('students', StudentController::class);

        Route::get('profile', [ProfileController::class, 'index']);

        Route::put('profile', [ProfileController::class, 'update']);
    });
});