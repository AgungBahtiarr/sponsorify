<?php

use App\Http\Controllers\web\StatusController;
use App\Http\Controllers\web\RoleController;
use App\Http\Controllers\web\DashboardController;
use App\Http\Controllers\web\LoginController;
use App\Http\Controllers\web\UserController;
use App\Http\Controllers\web\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [LoginController::class, 'index']);
Route::post('/admin/login', [LoginController::class, 'login']);


Route::get('/admin', [DashboardController::class, 'index']);


// User Management
Route::get('/admin/user', [UserController::class, 'index']);
Route::patch('/admin/user/{id}', [UserController::class, 'update']);
Route::delete('/admin/user/{id}', [UserController::class, 'destroy']);

// Role Management
Route::get('/admin/role', [RoleController::class, 'index']);
Route::post('/admin/role', [RoleController::class, 'store']);
Route::patch('/admin/role/{id}', [RoleController::class, 'update']);
Route::delete('/admin/role/{id}', [RoleController::class, 'destroy']);


Route::get('/admin/category', [CategoryController::class, 'index']);
Route::get('/admin/status', [StatusController::class, 'index']);

