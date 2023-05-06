<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\UserController;

use App\Http\Middleware\WithoutLinks;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);

Route::middleware(['auth.api'])->group(function () {
    // Route::apiResource('users', UserController::class)->except('store')->middleware('withoutlink');
    // Route::post('users', [UserController::class, 'store']);

    Route::post('/logout', [PassportAuthController::class, 'logout']);

    Route::get('/test', function() {
        return response()->json(['message' => 'This is a test route']);
    });
});
