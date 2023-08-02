<?php

use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\GroupController;
use App\Http\Controllers\Dashboard\ModuleController;
use App\Http\Controllers\Dashboard\PromoterController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\TeacherController;
use App\Http\Controllers\Dashboard\ToggleStatusController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/dashboard');

Route::middleware(['auth'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('', DashboardController::class)
            ->name('index');

        Route::resource('promoters', PromoterController::class)
            ->only(['index', 'store', 'update']);

        Route::put('toggle-status', ToggleStatusController::class)
            ->name('toggle-status');

        Route::resource('courses', CourseController::class)
            ->except(['edit', 'create', 'destroy']);

        Route::resource('modules', ModuleController::class)
            ->only(['store', 'update']);

        Route::resource('teachers', TeacherController::class)
            ->only(['index', 'store', 'update']);

        Route::resource('groups', GroupController::class);

        Route::resource('students', StudentController::class);
    });
