<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\todoController;


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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('todos',[todoController::class,'index']);
// Route::post('todos',[todoController::class,'create']);
// Route::get('todos/{id}',[todoController::class,'show']);
// Route::get('todos/{id}/edit',[todoController::class,'edit']);
// Route::put('todos/{id}/edit',[todoController::class,'update']);
// Route::delete('todos/{id}/destroy',[todoController::class,'destroy']);