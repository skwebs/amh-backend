<?php

use App\Http\Controllers\API\V1\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth:sanctum"])->group(function () {
    Route::apiResource("transaction", TransactionController::class);
});
