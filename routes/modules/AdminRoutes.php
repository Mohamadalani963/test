<?php

namespace Routes\APIs\AdminRoutes;

use App\Http\Controllers\Api\AdminController\ContactUsController;
use App\Http\Controllers\Api\AdminController\SupportMessageController;
use Illuminate\Support\Facades\Route;


//TODO Add middleware here
Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::prefix('supportMessage')->controller(SupportMessageController::class)->group(function () {
        Route::get('/', 'index')->middleware('ability:supportMessage::index');
        Route::put('/{id}', 'update')->middleware('ability:supportMessage::update');
        Route::delete('/{id}', 'delete')->middleware('ability:supportMessage::delete');
    });
    Route::prefix('contactUs')->controller(ContactUsController::class)->group(function () {
        Route::get('/', 'index')->middleware('ability:contactUs::index');
        Route::put('/{id}', 'update')->middleware('ability:contactUs::update');
        Route::delete('/{id}', 'delete')->middleware('ability:contactUs::delete');
    });
});
