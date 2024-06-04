<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BinderyAttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NormalAttributeController;
use App\Http\Controllers\StateController;
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
Route::post('/add_state',[StateController::class,'Create']);
Route::post('/active_or_not_state',[StateController::class,'ActiveOrNot']);
Route::delete('/delete_state',[StateController::class,'Delete']);
Route::get('/show_one_state',[StateController::class,'ShowById']);
Route::get('/show_states',[StateController::class,'ShowAll']);
Route::post('/update_state',[StateController::class,'Update']);


Route::post('/add_category',[CategoryController::class,'Create']);
Route::post('/active_or_not_category',[CategoryController::class,'ActiveOrNot']);
Route::delete('/delete_category',[CategoryController::class,'Delete']);
Route::get('/show_one_category',[CategoryController::class,'ShowById']);
Route::get('/show_categories',[CategoryController::class,'ShowAll']);
Route::post('/update_category',[CategoryController::class,'Update']);


Route::post('/add_bindery_att',[BinderyAttributeController::class,'Create']);
Route::get('/show_one_bindery_att',[BinderyAttributeController::class,'ShowById']);
Route::post('/update_bindery_att',[BinderyAttributeController::class,'Update']);
Route::get('/show_bindery_atts',[BinderyAttributeController::class,'ShowAll']);
Route::delete('/delete_bindery_att',[BinderyAttributeController::class,'Delete']);


Route::post('/add_normal_att',[NormalAttributeController::class,'Create']);
Route::get('/show_one_normal_att',[NormalAttributeController::class,'ShowById']);
Route::post('/update_normal_att',[NormalAttributeController::class,'Update']);
Route::get('/show_normal_atts',[NormalAttributeController::class,'ShowAll']);
Route::delete('/delete_normal_att',[NormalAttributeController::class,'Delete']);
