<?php

use App\Http\Controllers\AdminController;
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

Route::post('/login',[AdminController::class,'Login']); 

Route::group(['middleware' => ['auth:Admin', 'scope:Admin']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::post('/add_admin', 'Create');
        Route::delete('/delete_admin', 'DeleteById');
        Route::post('/active_or_not_admin', 'ActiveOrNot');
        Route::get('/show_one_admin', 'ShowById');
        Route::get('/show_admin_permissions', 'ShowAdminPermissions');
        Route::post('/update_admin_permissions', 'UpdateAdminPermissions');
        Route::get('/show_admins', 'ShowAll');
        Route::post('/update_admin', 'Update');
        Route::post('/logout', 'Logout');
        //Route::post('/update_password', 'ChangePassword');
    });
});

