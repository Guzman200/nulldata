<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {

    Route::get('employee', [EmployeeController::class, 'index']);
    Route::get('employee/{employee}', [EmployeeController::class, 'show']);
    Route::post('employee', [EmployeeController::class, 'store']);
    Route::delete('employee/{employee}', [EmployeeController::class, 'delete']);

    Route::get('skills', [SkillController::class, 'index']);

});
