<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagController;
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
Route::get('/user', [UserController::class, 'show_user']);


Route::get('/show_aboutUs', [SettingController::class, 'ShowAboutUs']);
Route::get('/show_homePromo', [SettingController::class, 'ShowHomePromo']);

Route::post('/add_contactUs', [ContactUsController::class, 'create']);

Route::get('/show_tags', [TagController::class, 'index']);
Route::get('/products_with_tagId', [ProductTagController::class, 'showWithTagId']);
Route::get('/tags_with_productId', [ProductTagController::class, 'showWithProductId']);


Route::middleware(['auth:User'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/update_profile', [UserController::class, 'update']);
    Route::post('/reset_password', [UserController::class, 'ResetPassword']);

    Route::post('/add_rating', [RatingController::class, 'create']);
});