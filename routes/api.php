<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/test', function () {
//     return response()->json(['message' => 'API working']);
// });
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['auth:sanctum', 'role:admin'])->get('/admin', function () {
    return "Admin Access";
});

Route::middleware(['auth:sanctum', 'role:user'])->get('/user', function () {
    return "User Access";
});
