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
Route::post('/fcm/deviceToken', [App\Http\Controllers\Api\FirebaseController::class, 'deviceToken']);

Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'index']);
Route::post('/user/store', [App\Http\Controllers\Api\UserController::class, 'store']);
Route::get('/user/{id}', [App\Http\Controllers\Api\UserController::class, 'show']);
Route::get('/user/{id}/edit', [App\Http\Controllers\Api\UserController::class, 'editUser']);
Route::post('/user/{id}/update', [App\Http\Controllers\Api\UserController::class, 'updateUser']);
Route::post('/user/{id}/destroy', [App\Http\Controllers\Api\UserController::class, 'destroyUser']);


// Rutas protegidas con autenticación
Route::middleware('auth:api')->group(function () {

    //edit profile
    Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'edit']);
    Route::post('/user', [App\Http\Controllers\Api\UserController::class, 'update']);
    // end edit profile

    Route::post('/logout', [AuthController::class, 'logout']);

    /*RUTAS PARA EL CRUD DE SOLICITUDES DE PROVEEDORES*/
    Route::get('/suppliers', [App\Http\Controllers\Api\SupplierController::class, 'index']);
    Route::post('/supplier/store', [App\Http\Controllers\Api\SupplierController::class, 'store']);
    Route::get('/supplier/{id}', [App\Http\Controllers\Api\SupplierController::class, 'show']);
    Route::get('/supplier/{id}/edit', [App\Http\Controllers\Api\SupplierController::class, 'edit']);
    Route::post('/supplier/{id}/update', [App\Http\Controllers\Api\SupplierController::class, 'update']);

    /*RUTAS PARA EL CRUD DE SOLICITUDES DE PROVEEDORES*/
    Route::get('/requests-suppliers', [App\Http\Controllers\Api\SupplierRequestController::class, 'index']);
    Route::get('/request/{id}', [App\Http\Controllers\Api\SupplierRequestController::class, 'show']);
    Route::get('/request/{id}/edit', [App\Http\Controllers\Api\SupplierRequestController::class, 'edit']);
    Route::post('/request/{id}/update', [App\Http\Controllers\Api\SupplierRequestController::class, 'update']);
    /* END RUTAS CRUD SP */

    Route::post('/request/{id}/validate', [App\Http\Controllers\Api\StateRequestController::class, 'validateRequest']);
    Route::post('/request/{id}/receive', [App\Http\Controllers\Api\StateRequestController::class, 'receiveRequest']);
    Route::post('/request/{id}/approve', [App\Http\Controllers\Api\StateRequestController::class, 'approveRequest']);
    Route::post('/request/{id}/disapprove', [App\Http\Controllers\Api\StateRequestController::class, 'disapproveRequest']);
    Route::post('/request/{id}/cancel', [App\Http\Controllers\Api\StateRequestController::class, 'cancelRequest']);

    Route::get('/documents-request', [App\Http\Controllers\Api\DocumentController::class, 'index']);

    /* FCM */

    Route::get('/roles', [App\Http\Controllers\Api\RoleController::class, 'index']);
    Route::post('/role/store', [App\Http\Controllers\Api\RoleController::class, 'store']);
    Route::get('/role/{id}', [App\Http\Controllers\Api\RoleController::class, 'show']);
    Route::get('/role/{id}/edit', [App\Http\Controllers\Api\RoleController::class, 'editRole']);
    Route::post('/role/{id}/update', [App\Http\Controllers\Api\RoleController::class, 'updateRole']);

    Route::get('/questions', [App\Http\Controllers\Api\QuestionController::class, 'index']);
    Route::post('/question/store', [App\Http\Controllers\Api\QuestionController::class, 'store']);
    Route::get('/question/{id}/edit', [App\Http\Controllers\Api\QuestionController::class, 'edit']);
    Route::post('/question/{id}/update', [App\Http\Controllers\Api\QuestionController::class, 'update']);

    Route::get('/states', [App\Http\Controllers\Api\StateRequestController::class, 'index']);
    Route::post('/state/store', [App\Http\Controllers\Api\StateRequestController::class, 'store']);
    Route::get('/state/{id}/edit', [App\Http\Controllers\Api\StateRequestController::class, 'edit']);
    Route::post('/state/{id}/update', [App\Http\Controllers\Api\StateRequestController::class, 'update']);

    Route::get('/types-or-conditions-payments', [App\Http\Controllers\Api\TypePaymentRequestController::class, 'index']);
    Route::post('/type-or-condition-payment/store', [App\Http\Controllers\Api\TypePaymentRequestController::class, 'store']);
    Route::get('/type-or-condition-payment/{id}/edit', [App\Http\Controllers\Api\TypePaymentRequestController::class, 'edit']);
    Route::post('/type-or-condition-payment/{id}/update', [App\Http\Controllers\Api\TypePaymentRequestController::class, 'update']);
});
