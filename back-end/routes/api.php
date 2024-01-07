<?php

use App\Http\Controllers\TakerController;
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
Route::post('takers', [TakerController::class, 'create']);
Route::get('takers/{id}', [TakerController::class, 'read']);
Route::get('takers/{id}/edit', [TakerController::class, 'edit']);
Route::put('takers/{id}/edit', [TakerController::class, 'update']);
Route::delete('takers/{id}/delete', [TakerController::class, 'delete']);
