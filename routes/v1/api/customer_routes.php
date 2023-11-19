<?php

use App\Http\Controllers\API\V1\CustomerController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth:sanctum"])->group(function () {
    Route::apiResource("customers", CustomerController::class);
});



Route::middleware('auth:sanctum')->group(function () {
    // customer
    Route::get('customers/trashed', [CustomerController::class, 'trashed']);
    Route::get('customers/{id}/restore', [CustomerController::class, 'restore']);
    Route::apiResource('customers', CustomerController::class);
});
