<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\authe\ApiAuthController;
use App\Http\Controllers\api\CartApiController;
use App\Http\Controllers\api\CategoryApiController;
use App\Http\Controllers\api\OrderApiController;
use App\Http\Controllers\api\ProductApiController;
use App\Http\Controllers\api\TypeApiController;
use App\Http\Controllers\api\UserOrdersController;

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

Route::prefix('v1')->middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[ApiAuthController::class,'logout'])->name('api.logout');
    // products
    Route::get('/products',[ProductApiController::class,'index']);
    Route::post('/products',[ProductApiController::class,'store']);
    Route::put('/products/{id}',[ProductApiController::class,'update']);
    Route::delete('/products/{id}',[ProductApiController::class,'destory']);
    Route::get('/products/{id}',[ProductApiController::class,'show']);

    // categories
    Route::get('/categories',[CategoryApiController::class,'index']);
    Route::post('/categories',[CategoryApiController::class,'store']);
    Route::put('/categories/{id}',[CategoryApiController::class,'update']);
    Route::delete('/categories/{id}',[CategoryApiController::class,'destroy']);

    // types
    Route::get('/types',[TypeApiController::class,'index']);
    Route::post('/types',[TypeApiController::class,'store']);
    Route::put('/types/{id}',[TypeApiController::class,'update']);
    Route::delete('/types/{id}',[TypeApiController::class,'destroy']);

    //cart
    Route::get('/carts',[CartApiController::class,'index']);
    Route::post('/carts',[CartApiController::class,'store']);
    Route::delete('/carts/{id}',[CartApiController::class,'destroy']);

    // order
    Route::get('/orders',[OrderApiController::class,'index']);
    Route::post('/orders',[OrderApiController::class,'store']);
    Route::delete('/orders/{id}',[OrderApiController::class,'destroy']);
    Route::put('/orders/{id}',[OrderApiController::class,'update']);


});

Route::prefix('v1')->middleware('auth:sanctum','isAdmin')->group(function(){
    Route::get('/users/{id}/orders',[UserOrdersController::class,'index']);
    Route::get('/orders/township',[UserOrdersController::class,'township']);
});

Route::prefix('v1')->group(function(){
    Route::post('/register',[ApiAuthController::class,'register'])->name('api.register');
    Route::post('/login',[ApiAuthController::class,'login'])->name('api.login');
});
