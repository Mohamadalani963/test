<?php

namespace Routes\APIs\UserRoutes;

use App\Http\Controllers\Api\UserController\ContactUsController;
use App\Http\Controllers\Api\UserController\DeviceController;
use App\Http\Controllers\Api\UserController\FavoriteController;
use App\Http\Controllers\Api\UserController\OfferController;
use App\Http\Controllers\Api\UserController\ParamController;
use App\Http\Controllers\Api\UserController\ShoppingListController;
use App\Http\Controllers\Api\UserController\SupportMessageController;
use Illuminate\Support\Facades\Route;


//TODO Add middleware here
Route::prefix('param')->controller(ParamController::class)->group(function () {
    Route::get('/', 'index');
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('supportMessage')->controller(SupportMessageController::class)->group(function () {
        Route::post('/', 'store')->middleware('ability:supportMessage::store');
    });
    Route::prefix('contactUs')->controller(ContactUsController::class)->group(function () {
        Route::post('/', 'store')->middleware('ability:contactUs::store');
    });
    Route::controller(DeviceController::class)->group(function () {
        Route::put('/refreshFcmToken', 'refreshFcmToken');
    });
    Route::prefix('shoppingList')->controller(ShoppingListController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::delete('/all', 'deleteAll');
        Route::delete('/{id}', 'delete');
    });
    Route::prefix('favorite')->controller(FavoriteController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::delete('/{product_id}', 'delete');
    });

    Route::prefix('user/offers')->controller(OfferController::class)->group(function () {
        Route::get('/', 'index')->middleware('ability:offer::index');
    });
});
