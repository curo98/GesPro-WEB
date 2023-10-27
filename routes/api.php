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


Route::post('/login', [AuthController::class, 'login']);

Route::get('/states', [Api\StateRequestController::class, 'index']);

Route::get('/types-payments', [Api\TypePaymentRequestController::class, 'index']);
Route::get('/methods-payments', [Api\MethodPaymentRequestController::class, 'index']);



Route::get('/departments', [Api\UbigeoPeruController::class, 'loadDepartments']);
Route::get('/provinces', [Api\UbigeoPeruController::class, 'loadProvinces']);
Route::get('/districts', [Api\UbigeoPeruController::class, 'loadDistricts']);

Route::get('/countries', [Api\CountrieController::class, 'getCountries']);

Route::get('/departments/{department}/provinces', [Api\UbigeoPeruController::class, 'getProvincesByDepartment']);
Route::get('/provinces/{province}/districts', [Api\UbigeoPeruController::class, 'getDistricts']);
Route::post('/requests-suppliers', [Api\SupplierRequestController::class, 'store']);



// Rutas protegidas con autenticación
Route::middleware('auth:api')->group(function () {
    Route::get('/user', [Api\UserController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/suppliers', [Api\SupplierController::class, 'index']);

    /*RUTAS PARA EL CRUD DE SOLICITUDES DE PROVEEDORES*/
    Route::get('/requests-suppliers', [Api\SupplierRequestController::class, 'index']);

    /* END RUTAS CRUD SP */

    Route::get('/documents-request', [Api\DocumentController::class, 'index']);
    Route::get('/questions-request', [Api\QuestionController::class, 'index']);
});
