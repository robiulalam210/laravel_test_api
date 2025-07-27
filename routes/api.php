<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('posts', PostController::class);
Route::get("list",[PostController::class,'index']);
Route::post("list",[PostController::class,'store']);
Route::put("list",[PostController::class,'index']);
Route::delete("list",[PostController::class,'index']);
