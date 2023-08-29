<?php

use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('branches', BranchController::class);

// Route::group(['middleware' => ['auth:sanctum'], "as" => "api."], function () {
// 	Route::get('groups', GroupController::class)->name('groups.index');
// });

Route::middleware(['auth:sanctum'])
    ->name('api.')
    ->group(function () {
    	Route::get('groups', GroupController::class)->name('groups.index');
});
