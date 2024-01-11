<?php

use App\Http\Controllers\TakerController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepressionTypeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\RelationshipController;
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
Route::post('takers', [TakerController::class, 'create']); // create takers
Route::get('takers/{id}', [TakerController::class, 'read']);
// Route::get('takers/{id}/edit', [TakerController::class, 'edit']);
Route::put('takers/{id}/edit', [TakerController::class, 'update']);
Route::delete('takers/{id}/delete', [TakerController::class, 'delete']);

//Admins
Route::get('admins', [AdminController::class, 'index']);
Route::post('admins', [AdminController::class, 'create']); 
Route::get('admins/{id}', [AdminController::class, 'read']);
// Route::get('admins/{id}/edit', [AdminController::class, 'edit']);
Route::put('admins/{id}/edit', [AdminController::class, 'update']);
Route::delete('admins/{id}/delete', [AdminController::class, 'delete']);

//Questions
Route::get('questions', [QuestionController::class, 'index']); 
Route::post('questions/{id}', [QuestionController::class, 'create']); 
Route::get('questions/{id}', [QuestionController::class, 'read']);
Route::put('questions/{q_id}/{a_id}/edit', [QuestionController::class, 'update']);
Route::delete('questions/{q_id}/{a_id}/delete', [QuestionController::class, 'delete']);

//Options
Route::get('options', [OptionController::class, 'index']); 
Route::post('options/{id}', [OptionController::class, 'create']); 
Route::get('options/{id}', [OptionController::class, 'read']);
Route::put('options/{o_id}/{a_id}/edit', [OptionController::class, 'update']);
Route::delete('options/{o_id}/{a_id}/delete', [OptionController::class, 'delete']);

//DepressionTypes
Route::get('depression-types', [DepressionTypeController::class, 'index']); 
Route::post('depression-types/{id}', [DepressionTypeController::class, 'create']); 
Route::get('depression-types/{id}', [DepressionTypeController::class, 'read']);
Route::put('depression-types/{d_id}/{a_id}/edit', [DepressionTypeController::class, 'update']);
Route::delete('depression-types/{d_id}/{a_id}/delete', [DepressionTypeController::class, 'delete']);

//Responses
Route::get('responses', [ResponseController::class, 'index']);
Route::post('responses/{id}', [ResponseController::class, 'create']); //
Route::get('responses/{id}', [ResponseController::class, 'read']); ////
Route::delete('responses/{id}/delete', [ResponseController::class, 'delete']);

////Relationships////
Route::get('questions-options', [RelationshipController::class, 'questionOption']); // display questions with options and scores
Route::get('admins-questions', [RelationshipController::class, 'adminQuestion']); // display questions made by admins
Route::get('admins-options', [RelationshipController::class, 'adminOption']); // display options made by admins