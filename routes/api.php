<?php

// use App\Http\Controllers\API\CustomerController;
// use App\Http\Controllers\API\TransactionController;
// use App\Http\Controllers\API\UserController;
// // use App\Http\Controllers\TransactionController;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "api" middleware group. Make something great!
// |
// */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::middleware('auth:sanctum')->group(function () {
//     // transaction
//     Route::apiResource('transaction', TransactionController::class);
//     // customer
//     Route::get('customers/trashed', [CustomerController::class, 'trashed']);
//     Route::get('customers/{id}/restore', [CustomerController::class, 'restore']);
//     Route::apiResource('customers', CustomerController::class);
//     // user
//     // Route::apiResource('users', UserController::class);
// });
// // Route::post('register', [UserController::class, 'register']);
// // Route::apiResource('users', UserController::class);
// // Route::post('login', [UserController::class, 'login']);

// Route::prefix('v1')->group(function () {
//     // base_path('routes/v1/routes.php');
//     // Route::post('register', [UserController::class, 'register']);
//     // Route::apiResource('users', UserController::class);
//     // Route::post('login', [UserController::class, 'login']);
// });

// // ... other routes

// require __DIR__ . '/user/account.php';
