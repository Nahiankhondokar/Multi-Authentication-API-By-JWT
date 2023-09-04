<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;

Route::post('admin/login', [AdminController::class, 'login']);
Route::post('admin/register', [AdminController::class, 'register']);

Route::prefix('admin')->middleware(['auth:admin'])->group(function(){
    Route::get('/list', [AdminController::class, 'adminList']);
});






