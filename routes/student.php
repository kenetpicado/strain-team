<?php

namespace App\Http\Controllers\API\Student\V1;

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "v1", "as" => "student."], function() {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('groups', GroupController::class)->name('groups.index');
    });
});