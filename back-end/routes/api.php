<?php

use App\Http\Controllers\TakerController;
use App\Http\Controllers\DiagnosisController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Takers
Route::get('takers', [TakerController::class, 'index']);
Route::post('takers', [TakerController::class, 'create']); //
Route::get('takers/{id}', [TakerController::class, 'read']);
Route::get('takers/{id}/edit', [TakerController::class, 'edit']);
Route::put('takers/{id}/edit', [TakerController::class, 'update']);
Route::delete('takers/{id}/delete', [TakerController::class, 'delete']);

//Diagnosis 
Route::get('diagnosis', [DiagnosisController::class, 'index']);
Route::post('diagnosis/{id}', [DiagnosisController::class, 'create']); //
Route::get('diagnosis/{id}', [DiagnosisController::class, 'read']);
Route::delete('diagnosis/{id}/delete', [DiagnosisController::class, 'delete']);