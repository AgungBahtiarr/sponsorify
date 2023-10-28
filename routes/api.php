<?php

use App\Http\Controllers\api\EventControllerApi;
use App\Http\Controllers\api\ProposalControllerApi;
use App\Http\Controllers\api\SavedControllerApi;
use App\Http\Controllers\api\SponsorshipControllerApi;
use App\Http\Controllers\api\UnLoginController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Handle UnLogin
Route::get('', [UnLoginController::class,'index'])->name('login');
Route::post('', [UnLoginController::class,'index'])->name('login');
Route::put('', [UnLoginController::class,'index'])->name('login');
Route::patch('', [UnLoginController::class,'index'])->name('login');
Route::delete('', [UnLoginController::class,'index'])->name('login');


// Event
Route::get('/event', [EventControllerApi::class, 'index'])->middleware('auth:sanctum');
Route::post('/event', [EventControllerApi::class, 'store'])->middleware('auth:sanctum');
Route::patch('/event/{id}', [EventControllerApi::class, 'update'])->middleware('auth:sanctum');
Route::delete('/event/{id}', [EventControllerApi::class, 'destroy'])->middleware('auth:sanctum');


//Sponsorship
Route::get('/sponsorship', [SponsorshipControllerApi::class, 'index'])->middleware('auth:sanctum');
Route::post('/sponsorship', [SponsorshipControllerApi::class, 'store'])->middleware('auth:sanctum');
Route::patch('/sponsorship/{id}', [SponsorshipControllerApi::class, 'update'])->middleware('auth:sanctum');
Route::delete('/sponsorship/{id}', [SponsorshipControllerApi::class, 'destroy'])->middleware('auth:sanctum');

// Proposal
Route::get('/proposal',[ProposalControllerApi::class,'index'])->middleware('auth:sanctum');
Route::get('/proposal/sponsorship',[ProposalControllerApi::class,'indexSponsor'])->middleware('auth:sanctum');
Route::post('/proposal',[ProposalControllerApi::class,'store'])->middleware('auth:sanctum');
Route::patch('/proposal/{id}',[ProposalControllerApi::class,'update'])->middleware('auth:sanctum');
Route::delete('/proposal/{id}',[ProposalControllerApi::class,'destroy'])->middleware('auth:sanctum');


// Saved
Route::get('/saved',[SavedControllerApi::class,'index'])->middleware('auth:sanctum');
Route::post('/saved',[SavedControllerApi::class,'store'])->middleware('auth:sanctum');








