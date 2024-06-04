<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\UserController;
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


Route::middleware(['auth:User'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/delete_account', [UserController::class, 'destroy']);
    Route::post('/update_profile', [UserController::class, 'update']);

    //
    Route::post('/update_aboutUs', [AboutUsController::class, 'update']);
//

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});