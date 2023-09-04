<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;

Route::post('admin/login', [AdminController::class, 'login']);
Route::post('admin/register', [AdminController::class, 'register']);
Route::get('admin/logout', [AdminController::class, 'logout']);

Route::prefix('admin')->middleware(['auth:admin'])->group(function(){
    Route::get('/list', [AdminController::class, 'adminList']);
    Route::get('/refresh', [AdminController::class, 'refresh']);
});






