<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\FirebaseController;
use App\Http\Controllers;

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

Route::redirect('/', 'login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/registrar-paso1', [App\Http\Controllers\ProveedorController::class, 'formStep1'])->name('r.step1');

Route::get('/register-paso2', [App\Http\Controllers\ProveedorController::class, 'formStep2'])->name('r.step2');

Route::get('/register-paso3', [App\Http\Controllers\ProveedorController::class, 'formStep3'])->name('r.step3');

Route::get('/register-step4', [App\Http\Controllers\ProveedorController::class, 'formStep4'])->name('r.step4');

Route::get('/register-step5', [App\Http\Controllers\ProveedorController::class, 'formStep5'])->name('r.step5');
Route::get('/requests', [Controllers\SupplierRequestController::class, 'index']);

Route::middleware(['auth', 'role:admin'])->namespace('Admin')->group(function () {
    Route::post('/fcm/send', [FirebaseController::class, 'sendAll']);
});

Route::middleware(['auth', 'role:compras,contabilidad'])->group(function () {

    Route::get('/suppliers', [Controllers\SupplierController::class, 'index'])->name('suppliers.index');



    Route::post('/requests/check/{id}', [Controllers\StateRequestController::class, 'check'])->name('requests.check');
    Route::post('/requests/receive/{id}', [Controllers\StateRequestController::class, 'receive'])->name('requests.receive');
    Route::post('/requests/approve/{id}', [Controllers\StateRequestController::class, 'approve'])->name('requests.approve'); //

});

