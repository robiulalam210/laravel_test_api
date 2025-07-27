<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('posts', PostController::class);
Route::get("list",[PostController::class,'index']);
Route::post("list",[PostController::class,'store']);


Route::apiResource('students', StudentController::class);
