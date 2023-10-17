<?php

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

//Route::post('register', [AuthController::class, 'register']);
//Route::post('/register', [App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Auth\AuthController::class, 'login']);

Route::get('/states', [App\Http\Controllers\Api\StateRequestController::class, 'index']);
Route::get('/suppliers', [App\Http\Controllers\Api\SupplierController::class, 'index']);
Route::get('/types-payments', [App\Http\Controllers\Api\TypePaymentController::class, 'index']);
Route::get('/methods-payments', [App\Http\Controllers\Api\MethodPaymentController::class, 'index']);
Route::get('/requests-suppliers', [App\Http\Controllers\Api\SupplierRequestController::class, 'index']);
Route::get('/documents-request', [App\Http\Controllers\Api\DocumentController::class, 'index']);
Route::get('/questions-request', [App\Http\Controllers\Api\QuestionController::class, 'index']);


Route::middleware('auth:api')->group(function () {
    Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'show']);
    Route::post('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
});
