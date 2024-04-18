<?php

namespace Routes\APIs\AdminRoutes;

use App\Http\Controllers\Api\AdminController\SupportMessageController;
use Illuminate\Support\Facades\Route;


//TODO Add middleware here
Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::prefix('supportMessage')->controller(SupportMessageController::class)->group(function () {
        Route::get('/', 'index');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});
