<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::group(['middleware' => ['auth:sanctum']], function () {
// });
Route::middleware('auth:sanctum')->group(function () {
    // Routes that require authentication
    Route::get('/products/search/{name}', [ProductController::class, 'search']);
});

// for simple CRUD app, resource will provide all routes
// `php artisan route:list` will show all the routes
Route::resource('products', ProductController::class);
Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::post('/register', [AuthController::class, 'register']);
Route::delete('/logout', [AuthController::class, 'logout']);

// Route::get('/products', [ProductController::class, 'index']);

// Route::post('/products', [ProductController::class, 'store']);
