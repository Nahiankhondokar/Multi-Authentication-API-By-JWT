<?php

use App\Http\Controllers\Api\CustomerController;
use Illuminate\Support\Facades\Route;

Route::post('customer/login', [CustomerController::class, 'login']);
Route::get('customer/logout', [CustomerController::class, 'logout']);
Route::post('customer/register', [CustomerController::class, 'register']);

Route::get('customer/list', [CustomerController::class, 'adminList']);
