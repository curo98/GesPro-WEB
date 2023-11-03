<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
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
Route::post('/register', [AuthController::class, 'register']);

Route::get('/states', [App\Http\Controllers\Api\StateRequestController::class, 'index']);

Route::get('/types-payments', [App\Http\Controllers\Api\TypePaymentRequestController::class, 'index']);
Route::get('/methods-payments', [App\Http\Controllers\Api\MethodPaymentRequestController::class, 'index']);
Route::get('/policies', [App\Http\Controllers\Api\PolicyController::class, 'index']);


Route::get('/departments', [App\Http\Controllers\Api\UbigeoPeruController::class, 'loadDepartments']);
Route::get('/provinces', [App\Http\Controllers\Api\UbigeoPeruController::class, 'loadProvinces']);
Route::get('/districts', [App\Http\Controllers\Api\UbigeoPeruController::class, 'loadDistricts']);

Route::get('/countries', [App\Http\Controllers\Api\CountrieController::class, 'getCountries']);

Route::get('/departments/{department}/provinces', [App\Http\Controllers\Api\UbigeoPeruController::class, 'getProvincesByDepartment']);
Route::get('/provinces/{province}/districts', [App\Http\Controllers\Api\UbigeoPeruController::class, 'getDistricts']);
Route::post('/requests-suppliers', [App\Http\Controllers\Api\SupplierRequestController::class, 'store']);


Route::get('/questions-requests', [App\Http\Controllers\Api\QuestionController::class, 'index']);
Route::post('/fcm/token', [App\Http\Controllers\Api\FirebaseController::class, 'postToken']);
// Rutas protegidas con autenticación
Route::middleware('auth:api')->group(function () {

    //edit profile
    Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'edit']);
    Route::post('/user', [App\Http\Controllers\Api\UserController::class, 'update']);
    // end edit profile

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/suppliers', [App\Http\Controllers\Api\SupplierController::class, 'index']);

    /*RUTAS PARA EL CRUD DE SOLICITUDES DE PROVEEDORES*/
    Route::get('/requests-suppliers', [App\Http\Controllers\Api\SupplierRequestController::class, 'index']);

    /* END RUTAS CRUD SP */

    Route::get('/documents-request', [App\Http\Controllers\Api\DocumentController::class, 'index']);

    /* FCM */


});
