<?php

use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "auth"], function () {
    Route::post("register", [UserController::class, "register"]);
    Route::post("login", [UserController::class, "login"]);
});
Route::apiResource("users", UserController::class);
Route::get("user-by-uuid/{user:uuid}", [UserController::class, "userByUuid"]);
