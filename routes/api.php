<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/store', [TaskController::class, 'store']);
    Route::get('/edit/{id}', [TaskController::class, 'edit']);
    Route::post('/update/{id}', [TaskController::class, 'update']);
    Route::get('/status/{id}', [TaskController::class, 'status']);
    Route::get('/destroy/{id}', [TaskController::class, 'destroy']);
});
