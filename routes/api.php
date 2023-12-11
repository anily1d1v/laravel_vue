<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\todoController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('todos',[todoController::class,'index']);
Route::post('todos',[todoController::class,'create']);
Route::get('todos/{id}',[todoController::class,'show']);
Route::get('todos/{id}/edit',[todoController::class,'edit']);
Route::put('todos/{id}/edit',[todoController::class,'update']);
Route::delete('todos/{id}/destroy',[todoController::class,'destroy']);
