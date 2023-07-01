<?php

use App\Http\Controllers\Autenticacion\InicioSesionController;
use Illuminate\Support\Facades\Route;


Route::post('login', [InicioSesionController::class, 'login']);

Route::post('register', [InicioSesionController::class, 'register']);

Route::post('recover-password', [InicioSesionController::class, 'sendEmail']);

Route::put('change-password', [InicioSesionController::class, 'changePassword']);

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('logout', [InicioSesionController::class, 'logout']);

});