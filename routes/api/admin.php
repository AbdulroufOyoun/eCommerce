<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\BinderyAttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NormalAttributeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SocialLinkesController;
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


Route::post('/login', [AdminController::class, 'Login']);
Route::post('/add_state', [StateController::class, 'Create']);
Route::post('/active_or_not_state', [StateController::class, 'ActiveOrNot']);
Route::delete('/delete_state', [StateController::class, 'Delete']);
Route::get('/show_one_state', [StateController::class, 'ShowById']);
Route::get('/show_states', [StateController::class, 'ShowAll']);
Route::post('/update_state', [StateController::class, 'Update']);


Route::post('/add_category', [CategoryController::class, 'Create']);
Route::post('/active_or_not_category', [CategoryController::class, 'ActiveOrNot']);
Route::delete('/delete_category', [CategoryController::class, 'Delete']);
Route::get('/show_one_category', [CategoryController::class, 'ShowById']);
Route::get('/show_categories', [CategoryController::class, 'ShowAll']);
Route::post('/update_category', [CategoryController::class, 'Update']);


Route::post('/add_bindery_att', [BinderyAttributeController::class, 'Create']);
Route::get('/show_one_bindery_att', [BinderyAttributeController::class, 'ShowById']);
Route::post('/update_bindery_att', [BinderyAttributeController::class, 'Update']);
Route::get('/show_bindery_atts', [BinderyAttributeController::class, 'ShowAll']);
Route::delete('/delete_bindery_att', [BinderyAttributeController::class, 'Delete']);


Route::post('/add_normal_att', [NormalAttributeController::class, 'Create']);
Route::get('/show_one_normal_att', [NormalAttributeController::class, 'ShowById']);
Route::post('/update_normal_att', [NormalAttributeController::class, 'Update']);
Route::get('/show_normal_atts', [NormalAttributeController::class, 'ShowAll']);
Route::delete('/delete_normal_att', [NormalAttributeController::class, 'Delete']);


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

    Route::post('/update_homePromo', [SettingController::class, 'UpdateHomePromo']);
    Route::post('/update_aboutUs', [SettingController::class, 'UpdateAboutUs']);
    Route::get('/show_aboutUs', [SettingController::class, 'ShowAboutUs']);
    Route::get('/show_homePromo', [SettingController::class, 'ShowHomePromo']);

    Route::get('/show_paginate_users', [UserController::class, 'show_paginate_users']);
    Route::get('/show_ContactUs', [ContactUsController::class, 'show']);
    Route::delete('/delete_ContactUs', [ContactUsController::class, 'destroy']);
    Route::get('/active_or_not_user', [UserController::class, 'ActiveOrNotUser']);
    Route::delete('/delete_user', [UserController::class, 'Delete']);
    Route::get('/user', [UserController::class, 'show_user']);

    Route::get('/ShowSocial', [SocialController::class, 'ShowPlatforms']);
    Route::post('/AddSocial', [SocialController::class, 'AddPlatform']);
    Route::post('/ShowSocialPlatform', [SocialController::class, 'ShowById']);
    Route::post('/UpdateSocialPlatform', [SocialController::class, 'UpdateSocialPlatform']);
    Route::delete('/DeleteSocialPlatform', [SocialController::class, 'destroy']);

    Route::post('/AddSocialLink' ,[SocialLinkesController::class, 'AddSocialLink']);
    Route::post('/UpdateSocialLink' ,[SocialLinkesController::class, 'EditSocialLink']);
    Route::delete('/DeleteSocialLink' ,[SocialLinkesController::class, 'destroy']);
});
