<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomePromoController;
use App\Http\Controllers\UserController;
use App\Models\ContactUs;
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

Route::post('/signUp', [UserController::class, 'signUp']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/user/{id}', [UserController::class, 'show_user']);


Route::get('/show_aboutUs', [AboutUsController::class, 'show']);

Route::get('/show_homePromo', [HomePromoController::class, 'show']);

Route::post('/add_contactUs', [ContactUsController::class, 'create']);


Route::middleware(['auth:User'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/delete_account', [UserController::class, 'destroy']);
    Route::post('/update_profile', [UserController::class, 'update']);

    //
    Route::post('/update_aboutUs', [AboutUsController::class, 'update']);
    Route::post('/update_homePromo', [HomePromoController::class, 'update']);
    Route::get('/show_paginate_users', [UserController::class, 'show_paginate_users']);
    Route::get('/show_ContactUs', [ContactUsController::class, 'show']);
    Route::get('/delete_ContactUs/{id}', [ContactUsController::class, 'destroy']);

    //

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
