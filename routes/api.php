<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Models\Medico;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('medico', [App\Http\Controllers\MedicoAPIController::class, 'index']);
Route::get('medico/{id}', [App\Http\Controllers\MedicoAPIController::class, 'show']);
Route::post('medico', [App\Http\Controllers\MedicoAPIController::class, 'insert']);
Route::put('medico/{id}', [App\Http\Controllers\MedicoAPIController::class, 'update']);
Route::delete('medico/{id}', [App\Http\Controllers\MedicoAPIController::class, 'delete']);