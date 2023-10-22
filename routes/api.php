<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Auth\AuthController;

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


// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);

Route::get('/states', [Api\StateRequestController::class, 'index']);
Route::get('/suppliers', [Api\SupplierController::class, 'index']);
Route::get('/types-payments', [Api\TypePaymentRequestController::class, 'index']);
Route::get('/methods-payments', [Api\MethodPaymentRequestController::class, 'index']);
Route::get('/requests-suppliers', [Api\SupplierRequestController::class, 'index']);
Route::get('/documents-request', [Api\DocumentController::class, 'index']);
Route::get('/questions-request', [Api\QuestionController::class, 'index']);

Route::get('/departments', [Api\UbigeoPeruController::class, 'loadDepartments']);
Route::get('/provinces', [Api\UbigeoPeruController::class, 'loadProvinces']);
Route::get('/districts', [Api\UbigeoPeruController::class, 'loadDistricts']);

// Rutas protegidas con autenticación
Route::middleware('auth:api')->group(function () {
    Route::get('/user', [Api\UserController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
