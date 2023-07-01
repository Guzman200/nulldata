<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    

});



/** ============> ENDPOINTS SON AUTENTICACION <============================= */
Route::group(['prefix' => 'v1'], function () {

    Route::get('employee', [EmployeeController::class, 'index']);
    Route::post('employee', [EmployeeController::class, 'store']);

    Route::get('skills', [SkillController::class, 'index']);

});





