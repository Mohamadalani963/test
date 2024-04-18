<?php

namespace Routes\APIs\UserRoutes;

use App\Http\Controllers\Api\UserController\DeviceController;
use App\Http\Controllers\Api\UserController\SupportMessageController;
use Illuminate\Support\Facades\Route;


//TODO Add middleware here
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('supportMessage')->controller(SupportMessageController::class)->group(function () {
        Route::post('/', 'store')->middleware('ability:supportMessage::store');
    });
    Route::controller(DeviceController::class)->group(function () {
        Route::put('/refreshFcmToken', 'refreshFcmToken');
    });
});
