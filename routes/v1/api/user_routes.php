<?php

use App\Http\Controllers\API\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "auth"], function () {
    Route::post("register", [UserController::class, "register"]);
    Route::post("login", [UserController::class, "login"]);
});


Route::apiResource("users", UserController::class);

// Route::post('me', [UserController::class, 'me']);

Route::middleware('auth:sanctum')->group(function () {

    // Route::post('/logout-all', function () {
    //     auth()->user()->tokens()->delete();
    // });

    Route::group(["prefix" => "auth"], function () {

        Route::post('logout-all', function (Request $request) {
            return $request->user()->tokens()->delete();
        });

        Route::post('logout', function (Request $request) {
            return $request->user()->currentAccessToken()->delete();
        });

        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::get('/me', function (Request $request) {
            $user = auth()->user();

            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
            ]);
        });
    });
});
Route::get("user-by-uuid/{user:uuid}", [UserController::class, "userByUuid"]);
