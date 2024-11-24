<?php

namespace Routes\APIs\UserRoutes;

use App\Actions\StoreOwnerActions\MarketOwnerLogin;
use App\Actions\StoreOwnerActions\MarketOwnerRegistration;
use App\Actions\StoreOwnerActions\MarketOwnerVerify;
use App\Http\Controllers\Api\UserController\ContactUsController;
use App\Http\Controllers\Api\UserController\DeviceController;
use App\Http\Controllers\Api\UserController\FavoriteController;
use App\Http\Controllers\Api\UserController\OfferController;
use App\Http\Controllers\Api\UserController\ParamController;
use App\Http\Controllers\Api\UserController\ShoppingListController;
use App\Http\Controllers\Api\UserController\SupportMessageController;
use Illuminate\Support\Facades\Route;


//TODO Add middleware here
Route::prefix('marketOwner')->group(function () {

Route::prefix('auth')->group(function () {
    Route::post('/register',MarketOwnerRegistration::class);
    Route::post('/login',MarketOwnerLogin::class);
    Route::post('/verify',MarketOwnerVerify::class);

});
});
