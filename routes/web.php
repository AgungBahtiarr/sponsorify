<?php

use App\Http\Controllers\web\EventController;
use App\Http\Controllers\web\LogoutController;
use App\Http\Controllers\web\SponsorController;
use App\Http\Controllers\web\StatusController;
use App\Http\Controllers\web\RoleController;
use App\Http\Controllers\web\DashboardController;
use App\Http\Controllers\web\LoginController;
use App\Http\Controllers\web\UserController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Middleware\isLogin;
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

Route::get('/admin/login', [LoginController::class, 'index']);
Route::post('/admin/login', [LoginController::class, 'login']);

Route::middleware([isLogin::class])->group(function () {
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });

    // Logout
    Route::delete('/admin/logout', [LogoutController::class, 'logout']);

    // Dashboard
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

    // Category Management
    Route::get('/admin/category', [CategoryController::class, 'index']);
    Route::post('/admin/category', [CategoryController::class, 'store']);
    Route::patch('/admin/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy']);

    // Status Management
    Route::get('/admin/status', [StatusController::class, 'index']);
    Route::post('/admin/status', [StatusController::class, 'store']);
    Route::patch('/admin/status/{id}', [StatusController::class, 'update']);
    Route::delete('/admin/status/{id}', [StatusController::class, 'destroy']);

    // Sponsor Management
    Route::get('/admin/sponsor', [SponsorController::class, 'index']);
    Route::delete('/admin/sponsor/{id}', [SponsorController::class, 'destroy']);

    // Event Management
    Route::get('/admin/event', [EventController::class, 'index']);
    Route::delete('/admin/event/{id}', [EventController::class, 'destroy']);
});


