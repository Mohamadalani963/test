<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\MarketController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OfferImageController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

include(__DIR__ . '/modules/AdminRoutes.php');
include(__DIR__ . '/modules/UserRoutes.php');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::put('/locationUpdate', 'UpdateUserLocation');
        Route::get('/', 'show');
    });
    Route::prefix('district')->controller(DistrictController::class)->group(function () {
        Route::get('/', 'index')->middleware('ability:district::index');
        Route::get('/{id}', 'show')->middleware('ability:district::show');
        Route::put('/{id}', 'update')->middleware('ability:district::update');
        Route::delete('/{id}', 'delete')->middleware('ability:district::delete');
        Route::post('/', 'store')->middleware('ability:district::store');
    });
    Route::prefix('category')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->middleware('ability:category::index');
        Route::get('/{id}', 'show')->middleware('ability:category::show');
        Route::put('/{id}', 'update')->middleware('ability:category::update');
        Route::delete('/{id}', 'delete')->middleware('ability:category::delete');
        Route::post('/', 'store')->middleware('ability:category::store');
    });
    Route::prefix('market')->controller(MarketController::class)->group(function () {
        Route::get('/', 'index')->middleware('ability:market::index');
        Route::get('/{id}', 'show')->middleware('ability:market::show');
        Route::put('/{id}', 'update')->middleware('ability:market::update');
        Route::delete('/{id}', 'delete')->middleware('ability:market::delete');
        Route::post('/', 'store')->middleware('ability:market::store');
    });
    Route::prefix('branch')->controller(BranchController::class)->group(function () {
        Route::get('/', 'index')->middleware('ability:branch::index');
        Route::get('/{id}', 'show')->middleware('ability:branch::show');
        Route::put('/{id}', 'update')->middleware('ability:branch::update');
        Route::delete('/{id}', 'delete')->middleware('ability:branch::delete');
        Route::post('/', 'store')->middleware('ability:branch::store');
    });
    Route::prefix('offers')->controller(OfferController::class)->group(function () {
        Route::get('/', 'index')->middleware('ability:offer::index');
        Route::get('/{id}', 'show')->middleware('ability:offer::show');
        Route::put('/{id}', 'update')->middleware('ability:offer::update');
        Route::delete('/{id}', 'delete')->middleware('ability:offer::delete');
        Route::post('/', 'store')->middleware('ability:offer::store');
        Route::put('/attach_branch/{id}', 'attach_branch')->middleware('ability:offer::attachBranch');
        Route::put('/detach_branch/{id}', 'detach_branch')->middleware('ability:offer::attachBranch');
    });
    Route::prefix('offerImages')->controller(OfferImageController::class)->group(function () {
        Route::delete('/{id}', 'delete')->middleware('ability:offerImage::delete');
        Route::post('/', 'store')->middleware('ability:offerImage::store');
    });

    Route::prefix('slider')->controller(SliderController::class)->group(function () {
        Route::get('/', 'index')->middleware('ability:slider::index');
        Route::post('/', 'store')->middleware('ability:slider::store');
        Route::delete('/{id}', 'delete')->middleware('ability:slider::delete');
    });

    //TODO Filters Base on mobile Application needs
    //TODO check deleting high level entities
    //TODO unit test


    //TODO code need some refactor:
    //seperate controllers for mobile and admin
    //work on the dashboard

    //TODO Action Watcher

});
