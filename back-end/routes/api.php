<?php

use App\Http\Controllers\TakerController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionController;
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
// Route::get('takers/{id}/edit', [TakerController::class, 'edit']);
Route::put('takers/{id}/edit', [TakerController::class, 'update']);
Route::delete('takers/{id}/delete', [TakerController::class, 'delete']);

//Diagnoses 
Route::get('diagnoses', [DiagnosisController::class, 'index']);
Route::post('diagnoses/{id}', [DiagnosisController::class, 'create']); //
Route::get('diagnoses/{id}', [DiagnosisController::class, 'read']);
Route::delete('diagnoses/{id}/delete', [DiagnosisController::class, 'delete']);

//Admins
Route::get('admins', [AdminController::class, 'index']);
Route::post('admins', [AdminController::class, 'create']); //
Route::get('admins/{id}', [AdminController::class, 'read']);
// Route::get('admins/{id}/edit', [AdminController::class, 'edit']);
Route::put('admins/{id}/edit', [AdminController::class, 'update']);
Route::delete('admins/{id}/delete', [AdminController::class, 'delete']);

//Questions
Route::get('questions', [QuestionController::class, 'index']); 
Route::post('questions/{id}', [QuestionController::class, 'create']); //
Route::get('questions/{id}', [QuestionController::class, 'read']);
Route::put('questions/{q_id}/{a_id}/edit', [QuestionController::class, 'update']);
Route::delete('questions/{id}/delete', [QuestionController::class, 'delete']);